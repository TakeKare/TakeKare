<?php
namespace Incidents\Controller;

use Incidents\Controller\AppController;
use Incidents\Model\Entity\Incident;
use Cake\ORM\TableRegistry;

/**
 * Incidents Controller
 *
 * @property \Incidents\Model\Table\IncidentsTable $Incidents
 */
class IncidentsController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait {
        index as crudIndex;
        save as crudSave;
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Areas.Cities'],
            'order' => ['Incidents.id' => 'DESC']
        ];

        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $receptivenesses = Incident::receptivenessList();

        $this->set(compact('ages', 'intoxications', 'receptivenesses'));

        $this->crudIndex();
    }

    public function save($id = null)
    {
        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $areas = $this->Incidents->Areas->getHierarchyList();
        $receptivenesses = Incident::receptivenessList();

        $subSupportTypesFull = $this->Incidents->SubSupportTypes
            ->find('all')
            ->where(['parent_id IS NOT' => null])
            ->order('pos');

        //debug($subSupportTypes->toArray());

        $this->crudSave($id);

        $this->set(compact('ages', 'intoxications', 'subSupportTypesFull', 'areas', 'receptivenesses'));
    }

    public function my()
    {
        // TODO: only show my team incidents

        $conditions = [];
        $contain = ['Areas.Cities'];
        $order = ['Incidents.id' => 'DESC'];

        if ($this->Auth->user('team_id')) {
            $conditions['team_id'] = $this->Auth->user('team_id');
        }

        $this->paginate = compact('conditions', 'contain', 'order');

        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $receptivenesses = Incident::receptivenessList();

        $this->set(compact('ages', 'intoxications', 'receptivenesses'));

        $this->crudIndex();
    }

    public function register($id = null)
    {
        // TODO: only allow to edit/add my team incidents

        $this->listUrl = ['action' => 'my'];

        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList(true);
        $receptivenesses = Incident::receptivenessList(true);
        $areas = $this->Incidents->Areas->getHierarchyList();

        $subSupportTypesFull = $this->Incidents->SubSupportTypes
            ->find('all')
            ->where(['parent_id IS NOT' => null])
            ->order('pos');

        if ($this->request->is(['post', 'put', 'patch']) && $this->Auth->user('team_id')) {
            $this->request->data['team_id'] = $this->Auth->user('team_id');
            $this->request->data['area_id'] = $this->Auth->user('area_id');
        }

        $this->crudSave($id);

        $referrals = $this->Incidents->Referrals
            ->find('all')
            ->order('pos');

        $supportTypes = $this->Incidents->SupportTypes
            ->find('all')
            ->where(['parent_id IS' => null])
            ->order('pos');

        $this->set(compact('ages', 'intoxications', 'subSupportTypesFull', 'areas', 'receptivenesses', 'referrals', 'supportTypes', 'userTeam'));
    }
}
