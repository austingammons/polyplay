<?php

require __DIR__ . '\exam.php';

class GenreExam {

    public function __construct()
    {
        
    }

    /**
    * Create a new Genre Record in the database
    *
    * @return int The newly created Genre Record Id created with the current PDO instance
    */
    function create(int $exam_id, int $gen_control_score, int $gen_concept_score, int $gen_computation_score, int $gen_community_score) {

        $user_id = $_SESSION["user_id"];

        $sql = 'INSERT INTO genres(user_id, exam_id, gen_control_score, gen_concept_score, gen_computation_score, gen_community_score)
            VALUES(:user_id, :exam_id, :gen_control_score, :gen_concept_score, :gen_computation_score, :gen_community_score)';

        $db = db();

        $statement = $db->prepare($sql);

        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', (int)$exam_id, PDO::PARAM_INT);
        $statement->bindValue(':gen_control_score', (int)$gen_control_score, PDO::PARAM_INT);
        $statement->bindValue(':gen_concept_score', (int)$gen_concept_score, PDO::PARAM_INT);
        $statement->bindValue(':gen_computation_score', (int)$gen_computation_score, PDO::PARAM_INT);
        $statement->bindValue(':gen_community_score', (int)$gen_community_score, PDO::PARAM_INT);


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
        $statement->bindValue(':pref_test_id', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':gen_test_id', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':com_control_score', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':com_concept_score', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':com_computation_score', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':com_community_score', $exam_id, PDO::PARAM_INT);
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

        $sql = 'DELETE FROM genres
                WHERE user_id=:user_id AND exam_id=:exam_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function calculate_genre_exam_points($ratings, $exam_id) {

        $available_ratings = [];

        $point_rating = [
            "Control" => 0,
            "Concept" => 0,
            "Computation" => 0,
            "Community" => 0,
        ];

        foreach ($ratings as $key => $value) {
            if (strlen($value)) {
                $temp_rating = explode(",", $value);
                array_push($available_ratings, $temp_rating);
            }
        }

        if (count($available_ratings) == 0) {
            return null;
        }

        for ($i=0; $i < count($available_ratings); $i++) { 

            $points = 5;

            switch ($available_ratings[$i][0]) {
                case "Control":
                    $point_rating["Control"] += $points;
                break;
                case "Concept":
                    $point_rating["Concept"] += $points;
                break;
                case "Computation":
                    $point_rating["Computation"] += $points;
                break;
                case "Community":
                    $point_rating["Community"] += $points;
                break;
            }

        }

        return $point_rating;

    }

    public function get_genre_exam_questions() {

        $options = $this->get_random_options();

        $required_options = $options;

        // define required matches
        $required_category_matches = [
            [0, 1],
            [0, 2],
            [0, 3],
            [1, 2],
            [1, 3],
            [2, 3]
        ];

        $exam = [];

        foreach ($required_category_matches as $rcm_key => $category_match_requirement) {

            $first_category_id = $category_match_requirement[0];
            $second_category_id = $category_match_requirement[1];

            $first = array_shift($required_options[$first_category_id]);
            $second = array_shift($required_options[$second_category_id]);

            $question = [
                $first,
                $second
            ];

            array_push($exam, $question);

        }

        // get other 6 random questions

        $used = [
            0 => [
                0 => false,
                1 => false,
                2 => false,
                3 => false
            ],
            1 => [
                0 => false,
                1 => false,
                2 => false,
                3 => false
            ],
            2 => [
                0 => false,
                1 => false,
                2 => false,
                3 => false
            ],
            3 => [
                0 => false,
                1 => false,
                2 => false,
                3 => false
            ],
        ];

        for ($i = 0; $i < 6; $i++) { 

            $safe_bar = 0;

            $first_random_category = 0;
            $first_random_option = 0;

            do {
                $first_random_category = random_int(0, 3);
                $first_random_option = random_int(0, 3);

                $safe_bar++;

                if ($safe_bar > 30) {
                    $safe_bar = 0;
                    break 1;
                }

            } while ($used[$first_random_category][$first_random_option]);

            $used[$first_random_category][$first_random_option] = true;
            $first_option = $options[$first_random_category][$first_random_option];

            $second_random_category = 0;
            $second_random_option = 0;

            do {
                $second_random_category = random_int(0, 3);
                $second_random_option = random_int(0, 3);

                $safe_bar++;

                if ($safe_bar > 30) {
                    $safe_bar = 0;
                    break 1;
                }

            } while ($used[$second_random_category][$second_random_option]);

            $used[$second_random_category][$second_random_option] = true;
            $second_option = $options[$second_random_category][$second_random_option];

            $random_question = [
                $first_option,
                $second_option
            ];

            array_push($exam, $random_question);

        }

        return $exam;

    }

    public function get_random_options() {

        $exam = new ExamNew();

        $test = [];

        $used = [
            "Control" => [],
            "Concept" => [],
            "Computation" => [],
            "Community" => [],
        ];

        foreach ($exam->genres as $genre_index => $genre_category) {

            $cats = [];

            foreach ($genre_category as $option_index => $option) {

                $indexer = -1;

                do {
                    $indexer = random_int(0, 3);
                } while (in_array($indexer, $used[$genre_index]));

                array_push($used[$genre_index], $indexer);

                $category_id = -1;

                switch ($genre_index) {
                    case 'Control':
                        $category_id = 0;
                        break;
                    case 'Concept':
                        $category_id = 1;
                        break;
                    case 'Computation':
                        $category_id = 2;
                        break;
                    case 'Community':
                        $category_id = 3;
                        break;
                }

                $option = [
                    "CategoryId" => $category_id,
                    "CategoryText" => $genre_index,
                    "OptionId" => $indexer,
                    "OptionText" => $option
                ];

                array_push($cats, $option);

            }

            array_push($test, $cats);

        }

        return $test;

    }

    

}