<?php

require __DIR__ . '\exam.php';

class PreferenceExam {

    public function __construct()
    {

    }

    function create(int $exam_id, int $pref_control_score, int $pref_concept_score, int $pref_computation_score, int $pref_community_score) {

        $user_id = $_SESSION["user_id"];

        $sql = 'INSERT INTO preferences(user_id, exam_id, pref_control_score, pref_concept_score, pref_computation_score, pref_community_score)
                VALUES(:user_id, :exam_id, :pref_control_score, :pref_concept_score, :pref_computation_score, :pref_community_score)';

        $db = db();

        $statement = $db->prepare($sql);

        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', (int)$exam_id, PDO::PARAM_INT);
        $statement->bindValue(':pref_control_score', (int)$pref_control_score, PDO::PARAM_INT);
        $statement->bindValue(':pref_concept_score', (int)$pref_concept_score, PDO::PARAM_INT);
        $statement->bindValue(':pref_computation_score', (int)$pref_computation_score, PDO::PARAM_INT);
        $statement->bindValue(':pref_community_score', (int)$pref_community_score, PDO::PARAM_INT);


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
    function read($exam_id, $test_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'SELECT *
                FROM preferences
                WHERE user_id=:user_id 
                AND exam_id=:exam_id
                AND test_id=:test_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':test_id', $test_id, PDO::PARAM_INT);
        $statement->execute();
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result == false ?? [];

    }

    /**
    * Deletes single existing Exam Record from the database
    *
    * @param int $exam_id
    * @return Bool True if Success, otherwise False
    */
    function destroy($exam_id, $test_id) {

        $user_id = $_SESSION["user_id"];

        $sql = 'DELETE FROM exams
                WHERE user_id=:user_id 
                AND exam_id=:exam_id
                AND test_id=:test_id';
    
        $statement = db()->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':exam_id', $exam_id, PDO::PARAM_INT);
        $statement->bindValue(':test_id', $test_id, PDO::PARAM_INT);
        
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function get_preference_exam_questions() {

        $exam = new ExamNew();

        $preference_questions = [];

        $used_questions = [
            "Control" => [],
            "Concept" => [],
            "Computation" => [],
            "Community" => [],
        ];

        for ($i=0; $i < 6; $i++) { 

            $question = [];

            foreach ($exam->categories as $key => $value) {

                $indexer = -1;

                do {

                    $indexer = random_int(0, 9);

                } while (in_array($indexer, $used_questions[$value]));

                array_push($used_questions[$value], $indexer);

                $option = [
                    "CategoryId" => $key,
                    "CategoryText" => $value,
                    "OptionId" => $indexer,
                    "OptionText" => $exam->preferences[$value][$indexer],
                    "Rating" => 0
                ];

                array_push($question, $option);

            }

            array_push($preference_questions, $question);

        }

        return $preference_questions;

    }

    public function calculate_preference_exam_points($ratings, $exam_id) {

        $available_ratings = [];

        // split answers
        foreach ($ratings as $key => $value) {
            if (strlen($value)) {
                $temp_rating = explode(",", $value);
                array_push($available_ratings, $temp_rating);
            }
        }

        $point_rating = [
            "Control" => 0,
            "Concept" => 0,
            "Computation" => 0,
            "Community" => 0,
        ];

        if (count($available_ratings) == 0) {
            return null;
        }

        // loop the available ratings
        for ($i=0; $i < count($available_ratings); $i++) { 

            $points = 3;

            $exam_options = $available_ratings[$i];

            // loop thru the exam options
            for ($j=0; $j < count($exam_options); $j++) { 

                // assign points based upon the order of the ratings
                switch ($exam_options[$j]) {
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

                --$points;

            }

        }

        return $point_rating;

    }

}