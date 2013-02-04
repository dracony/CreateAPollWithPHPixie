<?php
class Polls_Controller extends Controller
{
    protected $view;

    public function before() {

        // We load up the main view and
        $this->view = View::get('main');

        // Now we find a full path to a view that has
        // the same names as the action to be excuted
        $template = Misc::find_file('views', $this->request->param('action'));

        // We pass the view we located to our main template.
        // All properties assigned to a view will be available
        // as variables inside the template
        $this->view->template=$template;
    }

    public function after() {
        // After an action completes we render the view
        $this->response->body=$this->view->render();
   }

	public function action_index() {
	
		// We pass all stored polls to the view
		$this->view->polls = ORM::factory('poll')->find_all();
	}


	public function action_poll() {
		
		// Handle voting
		if ($this->request->method == 'POST') {
			
			// If an option is was supplied via POST we increment
			// its votes field by 1
			$option_id = $this->request->post('option');
			$option = ORM::factory('option')->where('id', $option_id)->find();
			$option->votes += 1;
			$option->save();
			
			// Now we redirect the user back to current polls' page
			// This is done so that refreshing a browser window will not
			// produce multiple votes
			$this->response->redirect('/polls/poll/' . $option->poll->id);
			$this->execute = false;
			return;
		}

		// You can get the url id parameter using param()
		$id=$this->request->param('id');
		$this->view->poll = ORM::factory('poll')->where('id', $id)->find();
	}

	public function action_add() {
		
		//We only need to perform this if the form was submitted
		if ($this->request->method == 'POST') {
			
			// Creating a new poll
			$poll = ORM::factory('poll');
			
			// This is how you access POST form data
			$poll->topic = $this->request->post('topic');
			
			// Save the poll to the database
			$poll->save();
			
			// Similarly we create and save options specified for this poll
			foreach($this->request->post('options') as $name) {
				if (empty($name)) {
					continue;
				}
				$option = ORM::factory('option');
				$option->name = $name;
				$option->save();
				
				// We add each option to the 'options' relation we defined for the poll
				$poll->add('options', $option);
			}
			
			// This will prevent after() from executing
			// we need to do this because there is no point of returning any data
			// if we redirect the user
			$this->execute=false;
			$this->response->redirect('/polls/');
			return;
		}
		
		// If the form was not submitted the after() method will
		// take care of showing the creation form
	}
  
}
