<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\datasource\ConnectionManager;

class DairyController extends AppController{

    public function index()
    {

        //今んとこworkers用
        $this->paginate = [
            'contain' => [
                'Users', 
                'Positions', 
                'Shifts', 
                'Duties', 
            ]
        ];

        //明日から６日分の日付取得
        $days = array();
        for($i = 1; $i < 7; $i++){
            $today = date("Y-m-d", strtotime("{$i} day"));
            $days[] = $today;
        } 
        //今日の日付を取得
        $today = date("Y-m-d");

        //機能の日付を取得
        $yesterday = date("Y-m-d", strtotime("-1 day"));
        
        $this->loadModels(["OrderNews", "Workers", "Statuses", "RiskDetections"]);

        //scheduleを今日の日付で取得
        $sql = "select schedules_id, schedule_start_date, schedule_end_date, schedule from schedules where '" . $today . "' between schedule_start_date and schedule_end_date";
        $connection = ConnectionManager::get("default");
        $today_schedules = $connection->execute($sql)->fetchAll("assoc");

        //scheduleを今日から1週間分取得
        $sql = "select schedules_id, schedule_start_date, schedule_end_date, schedule from schedules where 
            ('" . $days[0] . "' between schedule_start_date and schedule_end_date) or
            ('" . $days[1] . "' between schedule_start_date and schedule_end_date) or
            ('" . $days[2] . "' between schedule_start_date and schedule_end_date) or
            ('" . $days[3] . "' between schedule_start_date and schedule_end_date) or
            ('" . $days[4] . "' between schedule_start_date and schedule_end_date) or
            ('" . $days[5] . "' between schedule_start_date and schedule_end_date)";
        $weekry_schedules = $connection->execute($sql)->fetchAll("assoc");
 
        //weekry_schedulesからtoday_schedulesを引く
        foreach($today_schedules as $today_schedule){
            $i = 0;
            foreach($weekry_schedules as $weekry_schedule){
                if($today_schedule["schedules_id"] == $weekry_schedule["schedules_id"]){
                    unset($weekry_schedules[$i]);
                    $weekry_schedules = array_values($weekry_schedules);
                    break;
                }
                $i++;
            }
        }

        //order_newsを今日の分取得
        /*        
        $sql = "select * from schedules where '" . $today . "' between schedule_start_date and schedule_end_date";
        $connection = ConnectionManager::get("default");
        $schedules = $connection->execute($sql)->fetchAll("assoc");
        */
        //$orderNews = $this->OrderNews->find("all");
        
        //昨日のorder_newsを取得
        $orderNews = $this->OrderNews->find()
            ->select(["title", "comment"])
            ->where(["order_news_date" => $yesterday]);

        //$between = ["conditions" => ["Workers.date between '" . $today . "' and '" . $today . "'"]];
        //本日の勤務者
        //$workers = $this->Workers->find("all", $between)
        $workers = $this->Workers->find("all")
            ->where(["date" => $today]);
        $workers = $this->paginate($workers);
        $statuses = $this->Statuses->find("all")
        //$statuses = $this->Statuses->find("list")
            ->select(["status"]);

        //各ステータスそれぞれの件数を取得
        //ステータスの数
        $statusNumber = $statuses->count();
        //ステータス数を保存
        $nowStatus = [];
        $i = 1;
        foreach($statuses as $status)
        {
            $count = $this->RiskDetections->find("all")
                ->where(["statuses_id" => $i]);
            $count = $count->count();
            //$nowStatus = array_merge($nowStatus, [$status => $count]);
            //収束は表示しなくてよし
            if($status->status != "収束")
            {
                $nowStatus[$status->status] = $count;
            }
            $i++;
        }
        /*
        $statusA = $statuses->all();
        for($i = 1; $i >= $statusNumber; $i++)
        {
            array_push($nowStatus, $statusA[$i]->status)
            $nowStatus[$i] = $this->RiskDetections->find("all")
                ->where(["statuses_id" => $i]);
            $nowStatus[$i] = $nowStatus->count();
        }
         */



        $this->set(compact('today_schedules', "weekry_schedules", "orderNews", "today", "workers", "statuses", "nowStatus"));
    
    }
}
