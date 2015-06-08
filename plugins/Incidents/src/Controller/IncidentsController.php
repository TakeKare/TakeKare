<?php
namespace Incidents\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\InternalErrorException;
use Incidents\Controller\AppController;
use Incidents\Model\Entity\Incident;
use Cake\ORM\TableRegistry;
use Users\Model\Entity\User;

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

    use IncidentsFilterTrait;

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($this->Auth->user('role') == User::ROLE_TEAM_LEAD) {
            if (!$this->Auth->user('team_id')) {
                throw new InternalErrorException();
            }

            if ($this->request->action == 'index') {
                return $this->redirect(['action' => 'my']);
            }

            if ($this->request->action == 'save') {
                return $this->redirect(['action' => 'register']);
            }
        }
    }

    public function index()
    {
        $conditions = $this->_getIncidentsFilter();

        $this->paginate = [
            'contain' => ['Areas.Cities'],
            'conditions' => $conditions,
            'order' => ['Incidents.id' => 'DESC']
        ];

        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $receptivenesses = Incident::receptivenessList();
        $referrals = $this->Incidents->Referrals->find('list')->order('pos');
        $supportTypes = $this->Incidents->SupportTypes
            ->find('list')
            ->where(['parent_id IS' => null])
            ->order('pos');
        $areas = $this->Incidents->Areas->getHierarchyList();
        $teams = $this->Incidents->Teams->find('list')->order('title');

        $this->set(compact('ages', 'intoxications', 'receptivenesses', 'referrals', 'supportTypes', 'teams', 'areas'));

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
        if ($id
            && $this->Auth->user('role') == User::ROLE_TEAM_LEAD
            && !$this->Incidents->findByIdAndTeamId($id, $this->Auth->user('team_id'))->first()) {
            throw new InternalErrorException();
        }

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
