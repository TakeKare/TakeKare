<?php
namespace Incidents\Controller;

trait IncidentsFilterTrait {

    protected function _getIncidentsFilter()
    {
        $where = [];

        $query = [
            'area_id'         => null,
            'team_id'         => null,
            'age'             => null,
            'intoxication'    => null,
            'receptiveness'   => null,
            'referral_id'     => null,
            'support_type_id' => null,
            'created_from'    => '',
            'created_to'      => '',
        ];
        $query = array_merge($query, $this->request->query);

        if (!empty($query['area_id'])) {
            $where['Incidents.area_id IN'] = $query['area_id'];
        }
        if (!empty($query['team_id'])) {
            $where['Incidents.team_id IN'] = $query['team_id'];
        }
        if (!empty($query['age'])) {
            $where['age IN'] = $query['age'];
        }
        if (!empty($query['intoxication'])) {
            $where['intoxication IN'] = $query['intoxication'];
        }
        if (!empty($query['receptiveness'])) {
            $where['receptiveness IN'] = $query['receptiveness'];
        }
        if (!empty($query['referral_id'])) {
            $where['referral_id IN'] = $query['referral_id'];
        }
        if (!empty($query['support_type_id'])) {
            $where['support_type_id IN'] = $query['support_type_id'];
        }
        if (!empty($query['created_from'])) {
            $where['Incidents.created >='] = $query['created_from'];
        }
        if (!empty($query['created_to'])) {
            $where['Incidents.created <='] = $query['created_to'];
        }

        $this->set(compact('query'));

        return $where;
    }

}
