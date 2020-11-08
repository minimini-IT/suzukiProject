<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

/*
 * 認証用　追加
 */
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Psr\Http\Message\ServerRequestInterface;

/*
 * 承認用　追加
 */
use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Policy\OrmResolver;
use Psr\Http\Message\ServerResponseInterface;


class Application extends BaseApplication
    implements AuthenticationServiceProviderInterface,
    AuthorizationServiceProviderInterface
{
    public function bootstrap(): void
    {
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }

        /*
         * 承認用
         */
        $this->addPlugin("Authorization");

    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            ->add(new RoutingMiddleware($this))

            /*
             * 認証用　追加
             */
            ->add(new AuthenticationMiddleware($this))

            /*
             * 承認用　追加
             * 第二引数でDebugKitでのエラーを回避
             */
            ->add(new AuthorizationMiddleware($this, [
                "requireAuthorizationCheck" => false
            ]))
            //->add(new AuthorizationMiddleware($this))


            ->add(new BodyParserMiddleware())

            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]));

        return $middlewareQueue;
    }

    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
        }

        $this->addPlugin('Migrations');

    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $authenticationService = new AuthenticationService([
            "unauthenticatedRedirect" => "/managementUsers/login",
            "queryParam" => "redirect",
        ]);

        /*
         * 確認するフィールド
         * resolver->チェックするテーブル指定
         */
        $authenticationService->loadIdentifier("Authentication.Password", [
            "resolver" => [
                "className" => "Authentication.Orm",
                "userModel" => "ManagementUsers"
            ],
            "fields" => [
                "username" => "mail",
                "password" => "password",
            ]
        ]);

        /*
         * セッションの実行
         */
        $authenticationService->loadAuthenticator("Authentication.Session");

        /*
         * フォームデータチェックの設定
         */
        $authenticationService->loadAuthenticator("Authentication.Form", [
            "fields" => [
                "username" => "email",
                "password" => "password",
            ],
            "loginUrl" => "/managementUsers/login",
        ]);

        return $authenticationService;
    }

    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $resolver = new OrmResolver();
        $service = new AuthorizationService($resolver);

        /*
         * AuthorizationをDebugKitでは対象外にする
         */
        if($request->getParam("plugin") === "DebugKit")
        {
            $service->skipAuthorization();
        }

        return $service;
    }
}
