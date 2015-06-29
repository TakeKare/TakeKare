<?php
namespace Incidents\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Exception\InternalErrorException;
use Incidents\Controller\AppController;
use Users\Model\Entity\User;

/**
 * Teams Controller
 *
 * @property \Incidents\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait {
        index as crudIndex;
        save as crudSave;
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($this->Auth->user('role') == User::ROLE_TEAM_LEAD && $this->request->action != 'locations') {
            throw new InternalErrorException();
        }
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Areas.Cities']
        ];

        $this->crudIndex();
    }

    public function save($id = null)
    {
        $areasList = $this->loadModel('Incidents.Areas')->getHierarchyList();
        $this->set(compact('areasList'));

        $this->crudSave($id);
    }

    public function locations()
    {
        $teams = $this->Teams->find('all');

        if ($userTeamId = $this->Auth->user('team_id')) {
            $userTeam = $this->Teams->get($userTeamId);
            $teams = $teams->where(['area_id' => $userTeam->area_id]);
        }

        $incidents = [];
        foreach ($teams as $t) {
            $incidents[$t->id] = $this->loadModel('Incidents.Incidents')
                ->find('all')
                ->where([
                    'team_id' => $t->id,
                    'lat IS NOT' => null,
                    'lng IS NOT' => null,
                    'created >' => new Time('4 hours ago')
                ])
                ->order(['id' => 'DESC'])
                ->first();
        }

        $this->set(compact('teams', 'incidents'));
    }

}
