<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Journals Controller
 *
 * @property \App\Model\Table\JournalsTable $Journals
 *
 * @method \App\Model\Entity\Journal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JournalsController extends AppController
{


    public function beforeFilter(\Cake\Event\Event $event){
      $this->Auth->allow(['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

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




    /**
     * View method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $journal = $this->Journals->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('journal', $journal);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $journal = $this->Journals->newEntity();
        if ($this->request->is('post')) {
            $journal = $this->Journals->patchEntity($journal, $this->request->getData());
            if ($this->Journals->save($journal)) {

                $this->Flash->success(__('保存完了'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('エラーが発生しました。'));
        }
        $users = $this->Journals->Users->find('list', ['limit' => 200]);
        $this->set(compact('journal', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      $journal = $this->Journals->get($id, [
          'contain' => []
      ]);
      if ($this->request->is(['patch', 'post', 'put'])) {
          $journal = $this->Journals->patchEntity($journal, $this->request->getData());
          if ($this->Journals->save($journal)) {
              $this->Flash->success(__('保存完了'));

              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('エラーが発生しました。'));
      }
      $users = $this->Journals->Users->find('list', ['limit' => 200]);
      $this->set(compact('journal', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $journal = $this->Journals->get($id);
        if ($this->Journals->delete($journal)) {
            $this->Flash->success(__('削除完了'));
        } else {
            $this->Flash->error(__('エラーが発生しました。'));
        }

        return $this->redirect(['action' => 'listAdmin']);
    }



// Hyelim's own code

    public function listAdmin()
    {
              $filter = $this->request->query('filter');
        $keyword = $this->request->query('keyword');
        if(!empty($keyword)){

$query = $this->Journals->find()->contain('Users')->where([$filter.' LIKE'=> "%".$keyword."%"]);

$this->set('journals', $this->paginate($query));

      }else{
        $this->paginate = [
            'contain' => ['Users']
        ];
        // $journals = $this->paginate($this->Journals);
        // $this->set(compact('journals'));
        $time = Time::now();

        $query = $this->Journals->find('all')->where(['date' => $time]);
        $this->set('journals', $this->paginate($query));

      }
    }


    public function detailsAdmin($id = null)
    {
        $journal = $this->Journals->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $journal = $this->Journals->patchEntity($journal, $this->request->getData());
            if ($this->Journals->save($journal)) {
                $this->Flash->success(__('保存完了'));

                return $this->redirect(['action' => 'listAdmin']);
            }
            $this->Flash->error(__('エラーが発生しました。'));
        }
        $users = $this->Journals->Users->find('list', ['limit' => 200]);
        $this->set(compact('journal', 'users'));
    }



    public function listPersonal(){

      $query = $this->Journals->find('all')->where(['user_id' => $this->Auth->user('id')]);
      $this->set('journals', $this->paginate($query));
    }




    public function modify($id = null)
    {
      $journal = $this->Journals->get($id, [
          'contain' => []
      ]);
      if ($this->request->is(['patch', 'post', 'put'])) {
          $journal = $this->Journals->patchEntity($journal, $this->request->getData());
          if ($this->Journals->save($journal)) {
              $this->Flash->success(__('修正完了'));

              return $this->redirect(['action' => 'listPersonal']);
          }
          $this->Flash->error(__('エラーが発生しました。'));
      }
      $users = $this->Journals->Users->find('list', ['limit' => 200]);
      $this->set(compact('journal', 'users'));
    }


    public function start()
    {

      $journal = $this->Journals->newEntity();
      if ($this->request->is('post')) {
          $journal = $this->Journals->patchEntity($journal, $this->request->getData());
          if ($this->Journals->save($journal)) {
            $entity = $this->Journals->get($journal['id']);
            $this->Journals->touch($entity, 'Journals.open');
            $this->Journals->touch($entity, 'Users.login');
            $this->Journals->save($entity);
              $this->Flash->success(__('保存完了'));

              return $this->redirect(['action' => 'update', $journal->id]);
          }
          $this->Flash->error(__('エラーが発生しました。'));
      }
      $users = $this->Journals->Users->find('list', ['limit' => 200]);
      $this->set(compact('journal', 'users'));

}




    public function update($id = null)
    {
      $journal = $this->Journals->get($id, [
          'contain' => []
      ]);

      $query = $this->Journals->find()->where(['user_id' => $this->Auth->user('id')]);
$this->set('journals00', $this->paginate($query));



      if ($this->request->is(['patch', 'post', 'put'])) {
          $journal = $this->Journals->patchEntity($journal, $this->request->getData());
          if ($this->Journals->save($journal)) {
            $entity = $this->Journals->get($journal['id']);
            $this->Journals->touch($entity, 'Journals.close');
            $this->Journals->touch($entity, 'Users.logout');
            $this->Journals->save($entity);
              $this->Flash->success(__('修正完了'));

              return $this->redirect(['action' => 'listPersonal']);
          }
          $this->Flash->error(__('エラーが発生しました。'));
      }
      $users = $this->Journals->Users->find('list', ['limit' => 200]);
      $this->set(compact('journal', 'users'));
    }

}
