<?php
namespace App\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Http\Exception\InternalErrorException;
use Cake\Core\Exception\Exception;
use Cake\Datasource\ConnectionManager;

class BoardController extends AppController
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
     * 一覧表示
     * 
     * @return [type] [description]
     */
    public function index($id = null) {
        $this->viewBuilder()->autoLayout(false);

        if ($this->request->is('post')) {
            $data = $this->request->data();
            $entity = $this->Board->newEntity();
            
            $connection = ConnectionManager::get('default');
            $connection->begin();

            try {
                $board = $this->Board->patchEntity($entity, $data);
                $this->Board->save($board);
                return $this->redirect(['action' => 'send']);
                $connection->rollback();    
            } catch (Exception $ex) {
                $connection->rollback();
                throw new InternalErrorException(__('An unexpected error occurred'));
            }
        }

        $board = $this->Board->find()->order(['created' => 'DESC'])->where(['del_flg' => '0'])->limit('10')->toArray();
        $this->set('board', $board);
        $this->set('title', '掲示板');
    }     

    /**
     * 投稿完了画面を表示
     * 
     * @return [type] [description]
     */
    public function send() {
        $this->viewBuilder()->autoLayout(false);
        $this->set('title', '投稿完了');
    }

    /**
     * 削除ボタン押下時
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id = null)
    {
        $board = $this->Board->findById($id)->first();
        $board['del_flg'] = '1';

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
            if ($this->Board->save($board)) {
                $this->Flash->success(__('MessageSuccess'));
                return $this->redirect(['action' => 'index']);
            }
            $connection->rollback();    
        } catch (Exception $ex) {
            $connection->rollback();    
            throw new InternalErrorException(__('An unexpected error occurred'));
        }
    }
}
