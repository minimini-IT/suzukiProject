


        <div class="uk-text-center medium-table">
            <table class="uk-table uk-table-striped uk-table-middle">
                <thead>
                    <tr>
                        <th class="uk-text-center">ペンネーム</th>
                        <th class="uk-text-center">病名</th>
                        <th class="uk-text-center">性別</th>
                        <th class="uk-text-center">発病時の年齢</th>
                        <th class="uk-text-center">発病年月</th>
                        <th class="uk-text-center">診断日</th>
                        <th class="uk-text-center">完治した年月</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?= h($patient->pen_name) ?> さん</td>
                            <td>
                                <?php foreach ($patient->diseaseds as $diseased): ?>
                                    <?= h($diseased->sickness->sickness_name) ?></br>
                                <?php endforeach ?>
                            </td>
                            <td><?= h($patient->patient_sex->patient_sex) ?></td>
                            <td><?= $this->Number->format($patient->age_of_onset) ?></td>
                            <td><?= h($patient->year_of_onset->format("Y年n月")) ?></td>
                            <td><?= h($patient->diagnosis_date->format("Y年n月")) ?></td>
                            <td><?= $patient->has("cured") ? h($patient->cured->format("Y年n月")) : "-----" ?></td>
                            <td><?= $this->Html->link(__('詳細'), ['action' => 'view', $patient->patients_id], ["class" => "uk-button uk-button-default"]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>




