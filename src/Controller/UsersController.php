<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

  public function isAuthorized($user)
{
 $action = $this->request->params['action'];
 if(in_array($action, ['index', 'add'])){
   return true;
 }

 if(empty($this->request->params['pass'][0])) {
   return false;
 }
}

  public function beforeFilter(\Cake\Event\Event $event){
    $this->Auth->allow(['login']);
    $this->Auth->allow(['logout']);
  }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Journals']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('エラーが発生しました。'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('保存完了'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('エラーが発生しました。'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('削除完了'));
        } else {
            $this->Flash->error(__('エラーが発生しました。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
      if($this->Auth->user('id')){ //check if user is already logged in
          $this->Flash->error(__('あなたは既にログインしています。'));
          return $this->redirect(['controller'=>'Users', 'action'=>'index']);
      }
        //log a user in
        if($this->request->is('post')){
            //if the user is no already logged in, attempt to log user in.
          $user = $this->Auth->identify();

          if($user){
            $this->Auth->setUser($user);
            //redirect
            $this->Flash->success(__('ログイン完了'));
            // return $this->redirect(['controller' => 'Users', 'action'=>'index']);

            if(isset($user['email']) && $user['email'] === 'admin@admin.com'){
              return $this->redirect(['controller' => 'Journals', 'action'=>'listAdmin']);
            }else{



              // New journal entity with date, user_id and login time check

              // $journalsTable = TableRegistry::getTableLocator()->get('Journals');
              //
              // $journal = $journalsTable->newEntity();
              //
              // $journal->user_id = $auth['User']['id'];
              // $journal->date = $time;
              // $journal->loginT = $time;
              //
              // if ($journalsTable->save($journal)) {
              //     // The $article entity contains the id now
              //     $id = $journal->id;
              // }







              return $this->redirect(['controller' => 'Journals', 'action'=>'listPersonal']);
            }

          }

          $this->Flash->error(__('ログインエラーが発生しました。'));

    }
  }

    public function logout(){
      $this->Flash->success(__('ログアウト完了'));
      return $this->redirect($this->Auth->logout());
    }

    public function signup()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('保存完了'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('エラーが発生しました。'));
        }
        $this->set(compact('user'));
    }

}
