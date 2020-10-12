<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RiskDetection Entity
 *
 * @property int $risk_detections_id
 * @property int $incident_managements_id
 * @property \Cake\I18n\FrozenTime|null $occurrence_datetime
 * @property \Cake\I18n\FrozenTime $response_start_time
 * @property \Cake\I18n\FrozenTime|null $response_end_time
 * @property int $systems_id
 * @property int|null $bases_id
 * @property int|null $units_id
 * @property int $statuses_id
 * @property int $reports_id
 * @property int $positives_id
 * @property int $sec_levels_id
 * @property int $incident_cases_id
 * @property int $infection_routes_id
 * @property bool $sim_live_flag
 * @property bool $samari_flag
 * @property bool $attachment
 * @property string|null $comment
 *
 * @property \App\Model\Entity\System $system
 * @property \App\Model\Entity\Basis $basis
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Report $report
 * @property \App\Model\Entity\Positive $positive
 * @property \App\Model\Entity\SecLevel $sec_level
 * @property \App\Model\Entity\InfectionRoute $infection_route
 */
class RiskDetection extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'incident_managements_id' => true,
        'occurrence_datetime' => true,
        'response_start_time' => true,
        'response_end_time' => true,
        'systems_id' => true,
        'bases_id' => true,
        'units_id' => true,
        'statuses_id' => true,
        'reports_id' => true,
        'positives_id' => true,
        'sec_levels_id' => true,
        'incident_cases_id' => true,
        'infection_routes_id' => true,
        'sim_live_flag' => true,
        'samari_flag' => true,
        'attachment' => true,
        'comment' => true,
        'system' => true,
        'basis' => true,
        'unit' => true,
        'status' => true,
        'report' => true,
        'positive' => true,
        'sec_level' => true,
        'infection_route' => true
    ];
}
