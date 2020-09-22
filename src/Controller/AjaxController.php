<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;

class AjaxController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Board = TableRegistry::get('Board');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * 掲示板データを取得
     * @return [type] [description]
     */
    public function getBoard()
    {
        if ($this->request->is("ajax")) {
            $id = $this->request->data('id');
            $board = $this->Board->findById($id);
                $this->set([
                'board' => $board,
                '_serialize' => [
                    'board',
                ]
            ]);
        }
    }
}