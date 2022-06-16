<?php

/**
 * Author
 * Majisolv Developer - Austin
 * 
 * Created
 * 01.28.2022
 * 
 * Updated On / Author / Short Description
 * 
 * 01.28.2022 / M - Austin / Code Refactor
 * 
 * Description
 * This file contains the Exam class which handles
 * database communications to manage Exam records,
 * store important Exam data and also calculate personalities
 */

class ExamNew {

    function __construct()
    {
        
    }

    public $categories = [
        "Control",
        "Concept",
        "Computation",
        "Community",
    ];
    
    public $genres = [
        "Control" => [
            "Action",
            "First Person Shooter",
            "Platformer",
            "Fighting"
        ],
        "Concept" => [
            "Adventure",
            "Visual Novel",
            "Experimental",
            "Simulation"
        ],
        "Computation" => [
            "Real Time Strategy",
            "RPG",
            "Puzzle Solving",
            "Tactical"
        ],
        "Community" => [
            "MOBA",
            "MMOG",
            "E-Sports",
            "CTG (Collectible Trading Card Games)"
        ],
    ];
    
    public $preferences = [
        "Control" => [
            "Physics Based Challenges",
            "Motor Control Based Challenges",
            "Motion Controls",
            "Complex Controller Actions",
            "Highly Responsive Controls",
            "Adrenaline Pumping Action",
            "Reflex Based Challenges",
            "Quick Reaction Times",
            "Physical Immersion Into The World",
            "Fast Paced Gameplay"
        ],
        "Concept" => [
            "Intricate and Compelling Stories",
            "Memorable Characters",
            "Witty Character Dialogues",
            "Impressive Graphics",
            "Immersive World Exploration",
            "Artistically Challenging Gameplay",
            "Creative Expression Based Gameplay",
            "Unique Artstyles",
            "Complex Animations",
            "Memorable Music/Soundtrack"
        ],
        "Computation" => [
            "Rock Paper Scissors Inspired Gameplay",
            "Sophisticated Artificial Intelligence",
            "Complex Logic Based Challenges",
            "Strategic Thinking Based Gameplay",
            "High Level Mastery Curve",
            "Information Based Challenges",
            "Chess Inspired Gameplay",
            "Unique and Branching Skill/Data Trees",
            "Puzzle Solving Gameplay",
            "Griding Level Systems"
        ],
        "Community" => [
            "Team Based Game Interactions",
            "Communication Between Players",
            "Cooperative Player Based Gameplay",
            "Online Interaction Based Gameplay",
            "Social Sharing Experiences",
            "RealTime Societal Based Gameplay",
            "Competitive Player Based Gameplay",
            "Creating Internal Player Groups",
            "Player Tournament Based Gameplay",
            "Trading With Other Players"
        ],
    ];

    public $personalities = [
        [
            "Primary" => "Control",
            "Secondary" => "Concept",
            "Personality" => "The Audacious Maurader",
            "Description" => "Do you smell that? That's the smell of treasure in the air. A smell that leaves your "
            . "palms itching and fills your entire being. You are the Audacious Marauder. A vagabond who will sail "
            . "all seven seas to find and bathe in the decadence of riches. Exploring uncharted lands, trekking through "
            . "heavy jungles, climbing perilous cliffs; it all means nothing just as long as you can survive the danger "
            . "and acquire that sweet bounty!",
        ],
        [
            "Primary" => "Control",
            "Secondary" => "Computation",
            "Personality" => "The Maverick General",
            "Description" => "A keen mind with a swift hand. Two things every great general needs in order to assure "
            . "victory on the battlefield. You are the Maverick General. A strategist who will spend time planning "
            . "their attack, set up plays and ploys, and then take forceful action as you watch your enemies fall like "
            . "dominoes all around you. You think quickly on your feet and when pressed to enter the battlefield proper, "
            . "you are a force to  be reckoned with!"
        ],
        [
            "Primary" => "Control",
            "Secondary" => "Community",
            "Personality" => "The Title Champion",
            "Description" => "Atop the ropes and under the bright lights, you raise the gilded belt high above your head. "
            . "The crowd whoops and roars in anticipation for your match to start. You are the Title Champion. "
            . "You stand in the center of the ring, squat and ready to pummel all who dare to attempt a challenge with you. "
            . "It took a very long journey for you to claim the throne and you had to outmaneuver and fight many opponents "
            . "and take a couple of falls before you finally reached the top of the mountain. Let the challengers come, "
            . "you've made it to the top once before and you'll beat your way back to it again!"
        ],
        [
            "Primary" => "Concept",
            "Secondary" => "Control",
            "Personality" => "The Boisterous Knight",
            "Description" => "It is nighttime and you sit huddled around the campfire and look upwards toward the mountain. "
            . "A mighty roar suddenly bellows through the air but you are not afraid. You haven’t been afraid since you were "
            . "a page because now… You are the Boisterous Knight. The morning comes and the dragon must be slain. "
            . "Your weapon of choice, a sword forged in the lake of destiny, is unsheathed from your side. "
            . "You climb onto his back hoping to reach the neck of the slumbering monster before it awakes, "
            . "but alas it does. Now you hold on for dear life as the winged serpent takes flight and soars through the "
            . "air. You grit your teeth and say to yourself, 'This beast will be a blight no more!'"
        ],
        [
            "Primary" => "Concept",
            "Secondary" => "Computation",
            "Personality" => "The Astute Sage",
            "Description" => "Swipe left, swipe right, keep your back straight, and snap. The spell went off without a hitch. "
            . "You are the Astute Sage. The elements of magic crackle from your fingertips and it is all due to "
            . "the painstaking years of study you’ve had to endure to master them. You’ve learned that fire "
            . "overtakes the grass and that the grass overtakes the water. You’ve understood that proper control "
            . "of magic comes from knowing the rates of intensity you need to use to cast a spell. And with your "
            . "studious approach to magic, your skill grows and grows until the entire world is spellbound!"
        ],
        [
            "Primary" => "Concept",
            "Secondary" => "Community",
            "Personality" => "The Captivating Storyteller",
            "Description" => "The town square comes alive in a tither waiting in anticipation for the show. "
            . "The cues have been called, the velvet curtain has been raised, and it is time for you to give the "
            . "performance of a lifetime. You are The Captivating Storyteller. A living embodiment of the arts and "
            . "a masterful marksman when it comes to hitting the hearts of humans. People come and lay at your feet "
            . "just to see what you can do and you relish in the attention. You paint the world as they know it in "
            . "joyous yellows and morose blues. And when all has been said and done everyone gathers around as you "
            . "bask in thunderous applause!"
        ],
        [
            "Primary" => "Computation",
            "Secondary" => "Control",
            "Personality" => "The Super Scientist",
            "Description" => "Gingerly, you pick up the flasks and attempt your first combination of 2 rare elements. "
            . "Easy… Easy… Kaboom! You are the Super Scientist.  Accidents are necessary when it comes to progress and "
            . "you are more than prepared to handle them. Exploring the unknown requires both grit and intelligence and "
            . "you have both of these in spades. Your malleability is your strength. No brute or brain is a match against "
            . "your fists and wit!"
        ],
        [
            "Primary" => "Computation",
            "Secondary" => "Concept",
            "Personality" => "The Cunning Explorer",
            "Description" => "The hieroglyphs match the symbols on the weathered map you hold out in front of you. "
            . "With a torch in hand, you go through the entrance of the temple and enter the dark abyss. You are "
            . "the Cunning Explorer. The mysteries of the world have always intrigued you and you scour the earth "
            . "attempting to turn what has been lost to history into a living fact. You’ve pored over tons of "
            . "artifacts, conversed with locals close to the legend, and trekked to spaces unknown after you’ve "
            . "pieced it all together. The stories they will tell from your "
            . "harrowing adventures will be legendary!"
        ],
        [
            "Primary" => "Computation",
            "Secondary" => "Community",
            "Personality" => "The Nation Builder",
            "Description" => "The trumpets blare to commemorate your entrance into the room. At this sound, all the "
            . "guests cease conversation and gaze upon you. You are the Nation Builder. A ruler whose ingenuity knows "
            . "no bounds. Excellence has been the hallmark of your life and efficiency the main policy in which you "
            . "govern. Lesser royals wish to trade with you. And tyrants wish to take what you have and make it their "
            . "own. But to take from you is no small matter for your "
            . "rule is with a far-reaching golden scepter!"
        ],
        [
            "Primary" => "Community",
            "Secondary" => "Control",
            "Personality" => "The Rowdy Rumbler",
            "Description" => "These streets out here are tough, but there ain’t nothing tougher than you. "
            . "Folks out here might think they’re big and bad but they obviously must not know about you because... "
            . "You are the Rowdy Rumbler. You’ve been in more tussles than you can count and your gang is recognized by "
            . "local law enforcement as a living terror. Your allies in the streets are bonded by blood and any "
            . "rival gangs who attempt to lay claim to the piece of earth that you know is yours, better come correct. "
            . "Your knuckles are brandished and your mug is mean. Let anyone step outta line and they’ll hear "
            . "you say 'Come see me!'"
        ],
        [
            "Primary" => "Community",
            "Secondary" => "Concept",
            "Personality" => "The Legendary Space Hunter",
            "Description" => "The bar’s life stops as soon as you enter the room. You go up to the bartender and "
            . "lay a piece of paper forcefully on the counter. It reads 'Wanted: Dead or Alive.' You are the "
            . "Legendary Space Hunter. A vagabond and tall tale wrapped up in one person in the galaxy. "
            . "You can work with others so long as they know that the bounty on a perps head is yours to "
            . "claim. You are an excellent marksman and a disruptor of societies. When your mark lies between "
            . "the crosshairs it’s such a shame because you never miss!"
        ],
        [
            "Primary" => "Community",
            "Secondary" => "Compuation",
            "Personality" => "The Inquisitive Sleuth",
            "Description" => "There on the wall. It appears to be something viscous and sticky. You might need to "
            . "pull out your magnifying glass and go in for a closer inspection. You are the Inquisitive Sleuth. "
            . "When there’s a local mystery to be solved you’re typically on the case. Though misfortune always "
            . "seems to find you no matter where you are. Monstrosities typically lurk about and people always "
            . "seem to disappear around you and if you don’t want to be next you need to find out what’s going "
            . "on pronto. That’s ok, whomever is a liar usually has a tell, and you’re clever enough to avoid any "
            . "traps that might fall your way. The game is afoot!"
        ],
    ];

    /**
    * Create an Exam Record in the database
    *
    * @return int The newly created Exam Record Id created with the current PDO instance
    */
    function create() {

        $user_id = $_SESSION["user_id"];
        $sql = 'INSERT INTO exams(user_id)
        VALUES(:user_id)';

        $db = db();

        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);

        $statement->execute();
        $id = $db->lastInsertId();

        return $id;

    }

    /**
    * Obtain an Exam Record from the database
    *
    * @param int $exam_id
    * @return Array The Exam Record
    */
    function read($exam_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
                FROM exams
                WHERE user_id=:user_id AND exam_id=:exam_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    /**
    * Update an existing Exam Record in the database
    *
    * @return Bool True if Success, otherwise False
    */
    function update(int $exam_id, int $pref_test_id, int $gen_test_id, int $com_control_score, int $com_concept_score, int $com_computation_score, int $com_community_score) {

        $user_id = $_SESSION["user_id"];

        $sql = 'UPDATE exams
                SET 
                pref_test_id=:pref_test_id,
                gen_test_id=:gen_test_id,
                com_control_score=:com_control_score,
                com_concept_score=:com_concept_score,
                com_computation_score=:com_computation_score,
                com_community_score=:com_community_score
                WHERE user_id=:user_id AND exam_id=:exam_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':pref_test_id', $pref_test_id, PDO::PARAM_INT);
        $statement->bindValue(':gen_test_id', $gen_test_id, PDO::PARAM_INT);
        $statement->bindValue(':com_control_score', $com_control_score, PDO::PARAM_INT);
        $statement->bindValue(':com_concept_score', $com_concept_score, PDO::PARAM_INT);
        $statement->bindValue(':com_computation_score', $com_computation_score, PDO::PARAM_INT);
        $statement->bindValue(':com_community_score', $com_community_score, PDO::PARAM_INT);
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    /**
    * Deletes single existing Exam Record from the database
    *
    * @param int $exam_id
    * @return Bool True if Success, otherwise False
    */
    function destroy($exam_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'DELETE FROM exams
                WHERE user_id=:user_id AND exam_id=:exam_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    /**
    * Obtain all exams related to the logged in user
    *
    * @return Array The list of exams or an empty array if none exist
    */
    function all() {

        $user_id = $_SESSION["user_id"];

        //var_dump($user_id);

        $sql = 'SELECT * 
                FROM exams
                WHERE user_id=:user_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        
        $statement->execute();
    
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function get_all_preference_exams_global() {

        $sql = 'SELECT * 
        FROM preferences';

        $statement = db()->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function get_all_genre_exams_global() {

        $sql = 'SELECT * 
        FROM genres';

        $statement = db()->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function get_all_users_global() {

        $sql = 'SELECT * 
        FROM users';

        $statement = db()->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function get_all_exams_global() {

        $sql = 'SELECT * 
        FROM exams';

        $statement = db()->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function get_all_preference_exam_results_for_current_user() {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
                FROM preferences
                WHERE user_id=:user_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $statement->execute();
    
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_all_genre_exam_results_for_current_user() {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
                FROM genres
                WHERE user_id=:user_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $statement->execute();
    
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_user_exams() {

        $exams = $this->all();
        $results = [];

        foreach ($exams as $index => $exam) {
            
            $exam_results = $this->calculate_personality($exam["exam_id"]);
            array_push($results, $exam_results);

        }

        return $results;

    }

    public function get_last_exam() {
        
        $db = db();
        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
                FROM exams
                WHERE user_id=:user_id
                ORDER BY exam_id DESC
                LIMIT 1';
    
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result == false ? [] : $result;

    }

    /**
    * Obtain a preference exam related to the provided exam_id
    *
    * @param int $exam_id
    * @return Array The preference exam or an empty array if none exist
    */
    function get_preference_exam_by_exam_id($exam_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT * 
                FROM preferences
                WHERE user_id=:user_id AND exam_id=:exam_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        
        $statement->execute();
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;

    }

    /**
    * Obtain a genre exam related to the provided exam_id
    *
    * @param int $exam_id
    * @return Array The genre exam or an empty array if none exist
    */
    function get_genre_exam_by_exam_id($exam_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT * 
                FROM genres
                WHERE user_id=:user_id AND exam_id=:exam_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        
        $statement->execute();
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;

    }

    public function get_personality($exam_id) {

        $gen = $this->get_genre_exam_by_exam_id($exam_id);
        $pref = $this->get_preference_exam_by_exam_id($exam_id);

        $com_control_score = (int)$gen["gen_control_score"] + (int)$pref["pref_control_score"];
        $com_concept_score = (int)$gen["gen_concept_score"] + (int)$pref["pref_concept_score"];
        $com_computation_score = (int)$gen["gen_computation_score"] + (int)$pref["pref_computation_score"];
        $com_community_score = (int)$gen["gen_community_score"] + (int)$pref["pref_community_score"];

        $this->update($exam_id, $pref["test_id"], $gen["test_id"], $com_control_score, $com_concept_score, $com_computation_score, $com_community_score);

        $personality = $this->calculate_personality($exam_id);

        return $personality;

    }

    public function calculate_personality($exam_id) {

        // get the exam and calculate the com scores to obtain a personality

        /**
         * all data gathered is 'User Real Diamond Score'
         * top 2 cat pref is 'The Gameplay Personality'
         */

        $exam = $this->read($exam_id);

        $personality = [
            "Primary" => "",
            "Secondary" => "",
            "Personality" => "",
            "Description" => "",
            "Points" => [
                "Control" => [],
                "Concept" => [],
                "Computation" => [],
                "Community" => []
            ]
        ];

        $points = [
            "Control" => (int)$exam["com_control_score"],
            "Concept" => (int)$exam["com_concept_score"],
            "Computation" => (int)$exam["com_computation_score"],
            "Community" => (int)$exam["com_community_score"]
        ];

        $percents = [
            "Control" => 0,
            "Concept" => 0,
            "Computation" => 0,
            "Community" => 0
        ];

        if (!empty($exam)) {
            
            // define the tdcv
            $tdcv = (int)$exam["com_control_score"] + 
            (int)$exam["com_concept_score"] + 
            (int)$exam["com_computation_score"] + 
            (int)$exam["com_community_score"];

            // get percentages
            foreach ($points as $category => $total_category_points) {

                if ($total_category_points > 0) {

                    $temp_percent = $total_category_points / $tdcv;
                    $percents[$category] = (int)round((float)$temp_percent * 100);

                }

            }

            // assign percentages in result array
            $personality["Points"]["Control"] = $percents["Control"];
            $personality["Points"]["Concept"] = $percents["Concept"];
            $personality["Points"]["Computation"] = $percents["Computation"];
            $personality["Points"]["Community"] = $percents["Community"];

            // sort array max => min
            arsort($percents);

            $category_rating = [];

            foreach ($percents as $category => $value) {
                
                array_push($category_rating, $category);

            }

            $primary_trait = array_shift($category_rating);
            $secondary_trait = array_shift($category_rating);

            foreach ($this->personalities as $personality_index => $personality_data) {

                if ($personality_data["Primary"] == $primary_trait && $personality_data["Secondary"] == $secondary_trait) {

                    $personality["Primary"] = $personality_data["Primary"];
                    $personality["Secondary"] = $personality_data["Secondary"];
                    $personality["Personality"] = $personality_data["Personality"];
                    $personality["Description"] = $personality_data["Description"];

                    break;

                }

            }
            
        }
        
        return $personality;

    }

    public function incomplete_preference_exam() {
        ob_start();
        ?>
            <div>
                <a href="preferences.php">Preference Exam</a>
            </div>
        <?php
        $result = ob_get_clean();
        return $result;
    }

    public function incomplete_genre_exam() {
        ob_start();
        ?>
            <div>
                <a href="genres.php">Genre Exam</a>
            </div>
        <?php
        $result = ob_get_clean();
        return $result;
    }

    public function get_incomplete_test() {

        $last_exam = $this->get_last_exam();

        if (!empty($last_exam)) {

            $gen = $this->get_genre_exam_by_exam_id($last_exam["exam_id"]);
            $pref = $this->get_preference_exam_by_exam_id($last_exam["exam_id"]);

            if (empty($pref)) {
                return $this->incomplete_preference_exam();
            }

            if (empty($gen)) {
                return $this->incomplete_genre_exam();
            } 

        }

    }

    public function user_has_incomplete_test() {

        $result = false;
        $gen_ok = false;
        $pref_ok = false;

        $last_exam = $this->get_last_exam();

        if (!empty($last_exam)) {

            $gen = $this->get_genre_exam_by_exam_id($last_exam["exam_id"]);
            $pref = $this->get_preference_exam_by_exam_id($last_exam["exam_id"]);

            if (!empty($gen)) {
                $gen_ok = true;
            }

            if (!empty($pref)) {
                $pref_ok = true;
            }

            if (!$gen_ok || !$pref_ok) {
                $result = true;
            }

        }

        return $result;

    }

}

class ExamOld {

    function __construct()
    {
        
    }

    public function start() {

        $new_exam_record = $this->create_exam();
        redirect_to("preferences.php");

    }

    function get_completed_exams() {

        $exams = $this->get_all_exams();

    }

    public function incomplete_exam_exists() {

        $result = false;
        $gen_ok = false;
        $pref_ok = false;

        $latest_exam = $this->get_latest_exam_by_user_id();

        // there isn't an exam
        if (empty($latest_exam)) {
            
        } else {

            // check our gens and prefs here
            $gen = $this->get_gen_by_exam_id($latest_exam["exam_id"]);
            $pref = $this->get_pref_by_exam_id($latest_exam["exam_id"]);

            if (empty($gen)) {
                echo "gen is incomplete";
            } else {
                echo "gen is good";
                $gen_ok = true;
            }

            if (empty($pref)) {
                echo "pref is incomplete";
            } else {
                echo "pref is good";
                $pref_ok = true;
            }

            if (!$gen_ok || !$pref_ok) {
                $result = true;
            }

        }

        return $result;

    }

    public function get_latest_pref_exam_by_user_id() {
        
        // first get the latest exam
        $latest_exam = $this->get_latest_exam_by_user_id();

        $latest_exam_id = $latest_exam["exam_id"];
        $user_id = $_SESSION["user_id"];
        $db = db();

        $sql = 'SELECT *
                FROM preferences
                WHERE user_id=:user_id
                AND exam_id=:exam_id
                ORDER BY exam_id DESC
                LIMIT 1';
    
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $latest_exam_id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function get_latest_gen_exam_by_user_id() {
        
        // first get the latest exam
        $latest_exam = $this->get_latest_exam_by_user_id();

        $latest_exam_id = $latest_exam["exam_id"];
        $user_id = $_SESSION["user_id"];
        $db = db();

        $sql = 'SELECT *
                FROM genres
                WHERE user_id=:user_id
                AND exam_id=:exam_id
                ORDER BY exam_id DESC
                LIMIT 1';
    
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $latest_exam_id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function get_latest_exam_by_user_id() {
        
        $db = db();
        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
                FROM exams
                WHERE user_id=:user_id
                ORDER BY exam_id DESC
                LIMIT 1';
    
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result == false ? [] : $result;

    }

    public function get_exam_by_exam_id(int $exam_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
                FROM exams
                WHERE user_id=:user_id AND exam_id=:exam_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function get_all_exams() {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
        FROM exams
        WHERE user_id=:user_id';

        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_all_prefs() {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
        FROM preferences
        WHERE user_id=:user_id';

        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_all_gens() {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
        FROM genres
        WHERE user_id=:user_id';

        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_pref_by_exam_id($exam_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
        FROM preferences
        WHERE user_id=:user_id
        AND exam_id=:exam_id';

        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result == false ? [] : $result;

    }

    public function get_gen_by_exam_id($exam_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
        FROM genres
        WHERE user_id=:user_id
        AND exam_id=:exam_id';

        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result == false ? [] : $result;

    }

    public function create_exam() {

        $user_id = $_SESSION["user_id"];

        $sql = 'INSERT INTO exams(user_id)
        VALUES(:user_id)';

        $db = db();

        $statement = $db->prepare($sql);

        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);

        $result = $statement->execute();

        $id = $db->lastInsertId();

        return $id;

    }

}