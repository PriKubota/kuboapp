<?php
namespace App\Controller;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        //$this->MstDepart = TableRegistry::get('MstDepart');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

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
            $data = $this->request->data['Users'];
            var_dump($data);
            // exit;
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