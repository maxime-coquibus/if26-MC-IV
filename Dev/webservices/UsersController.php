<?php

class UsersController extends AppController
{

	 public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalide'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            debug($this->request->data);
            $this->request->data['User']['role'] ="joueur";
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Bienvenue'));
                return $this->redirect(array('action' => 'dashboard','controller'=>'Games'));
            } else {
                $this->Session->setFlash(__('L\'user n\'a pas été sauvegardé. Merci de réessayer.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User Invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('L\'user a été sauvegardé'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'user n\'a pas été sauvegardé. Merci de réessayer.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalide'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User supprimé'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('L\'user n\'a pas été supprimé'));
        return $this->redirect(array('action' => 'index'));
    }
	public function login() {

    if ($this->request->is('post')) {
       /* $fic = fopen("log.txt","a+");
        ob_start(); 
        print_r($this->request->data);
        fwrite($fic,ob_get_contents());
        ob_clean();
        fclose($fic);
        debug($this->request->data);exit();*/
		
		if(empty($this->Session->Auth) && isset($this->data))
		{
			// On compte le nombre de fois ou la connexion échoue
			if($this->Session->read('login.fail')) {
				$login_fail = $this->Session->read('login.fail') + 1;
			} else {
				$login_fail = 1;
			}
			
			// On enregistre dans une variable de session
			$this->Session->write("login.fail",$login_fail);
			// On lit la valeur 
			$readLoginFail = $this->Session->read('login.fail');
			// Si plus de 3 essais, on bloque l'utilisateur
			if ($readLoginFail > 3) {
				// On ajoute un délai de 30 minutes avant de pouvoir se reconnecter
				$this->Time->wasWithinLast('31 minutes', '1 minute');	// BUG ICI	
				// Appelé avec CakeTime
				App::uses('CakeTime', 'Utility');
				echo CakeTime::wasWithinLast($time_interval, $date_string);
				
				// C'est ok, on peut se reconnecter donc on repasse notre variable de session à 1
				echo 'Vous pouvez vous reconnecter';
				$login_fail = 1;
				$this->Session->write("login.fail",$login_fail);				
			} else {
				if ($this->Auth->login()) {
					// Connexion réussie
					return $this->redirect($this->Auth->redirect());
				} else {
					// Echec de la connexion, on l'indique à l'utilisateur
					$this->Session->setFlash(__("Nom d'user ou mot de passe invalide, réessayer"));
				}
			}
		}		
		}
	}

	public function logout() {
    	return $this->redirect($this->Auth->logout());
	}
}



?>