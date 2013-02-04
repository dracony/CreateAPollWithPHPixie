<?php
class Poll_Model extends ORM {
    // Each poll can have many options
    public $has_many = array('options');

    // This way we can define some additional
    // dynamic properties for a model.
    // Later on we will be able to access it via $poll->total_votes
    public function get($property) {
        if ($property == 'total_votes') {
            $total = 0;
            foreach ($this->options->find_all() as $option) {
                $total += $option->votes;
            }
            return $total;
        }
    }
}
