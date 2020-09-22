<?php
namespace App\Controller;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Detail = TableRegistry::get('Detail');
       
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    // 1ページに表示するデータ件数
    public $paginate = [
        'limit' => 3,
        // detailTable結合
        //'contain' => ['Detail']
    ];

    /**
     * ログイン処理
     * 
     * @return [type] [description]
     */
    public function login()
    {
        $this->viewBuilder()->autoLayout(false);
        if ($this->request->is('post')) {
            //フォームからの値を確認
            //$data = $this->request->data['Users'];
            // Postされたユーザー名とパスワードをもとにデータベースを検索。ユーザー名とパスワードに該当するユーザーがreturnされる
            $user = $this->Auth->identify();
            // var_dump($user);
            // exit;
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__("正しく入力してください"));
            }
        }
        //$this->Flash->set('defaultだよ。');
        $this->set('title', 'ログイン');
    }

    /**
     *  ログアウト処理
     * 
     * @return [type] [description]
     */
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * 一覧表示
     * 
     * @return [type] [description]
     */
    public function index() {
        //$this->viewBuilder()->autoLayout(false);

        $users = $this->paginate($this->Users);
        
        $this->set(compact('users'));
        $this->set('title', 'ユーザー 一覧');
    }

    /**
     * test
     * 
     * @return [type] [description]
     */
     public function test() {
        
            if ($this->request->is('post')) {
               $data = $this->request->data['Users'];

               $user = $this->Users->newEntity($data);
               $this->Users->save($user); 
            }
            return $this->redirect(['action' => 'index']);
    }
    
      
}