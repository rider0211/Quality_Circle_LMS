<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Quiz_model extends CI_Model
{
    
    /**
     * This function used to manage exams
     */
   	protected $table = 'exam_quiz';
    
    var $TYPES = array(
        "TrueFalse",
        "MultipleChoice",
        "MultipleResponse",
        "MultipleSwitch",
        "FillInTheBlank",
        "Sequence",
        "Matching",
        /*"FillInTheBlankEx",
        "MultipleChoiceText",
        "MultipleChoiceLine",
        "WordBank",
        "Numeric",*/
        "Grouping"
    );

    function where($filter) {
        if($filter["topic_id"])
            $this->db->where('exam_quiz.topic_id',$filter["topic_id"]);
        if($filter["category_id"])
            $this->db->where("exam_quiz.category_id",$filter["category_id"]);
        if($filter["type"])
            $this->db->where("exam_quiz.quiz_type",$filter["type"]);
        if($filter["level"])
            $this->db->where("exam_quiz.quiz_level",$filter["level"]);
        if($filter["quiz_id"]){
            $this->db->where_in('exam_quiz.id',$filter["quiz_id"]);
            $this->db->order_by(sprintf('FIELD(exam_quiz.id, %s)', implode(",", $filter["quiz_id"])));
        }
        if($filter["no_quiz_id"])
            $this->db->where_not_in('exam_quiz.id',$filter["no_quiz_id"]);
    }
    function count($filter = NULL) {
    	if($filter)
        	$this->where($filter);
        return $this->db->count_all_results('exam_quiz');
    }
    function all($filter = NULL) {
    	$this->db->join("exam_category","exam_quiz.category_id=exam_category.id","left");
        $this->db->join("training_topic","exam_quiz.topic_id=training_topic.id","left");
        $this->db->select("exam_quiz.*");
        $this->db->select("exam_category_name as category_name");
        $this->db->select("training_title");

        if($filter)
        	$this->where($filter);
        //$this->db->order_by("created_at desc");
        if($filter["limit"])
            return $this->db->get('exam_quiz',$filter["limit"],$filter["offset"])->result();
        
        return $this->db->get('exam_quiz')->result();
    }    
    function select($id) {
        $this->db->where(id, $id);
        $quiz = $this->db->get("exam_quiz")->row_array();
        $quiz["content"] = unserialize($quiz["quiz_content"]);
        return $quiz;
    }
    function remove($id) {
        $this->db->where(id, $id);
        $this->db->delete("exam_quiz");
    }
    function import($exam_quiz) {
        $this->db->where('uuid', $exam_quiz["uuid"]);
        $old = $this->db->get('exam_quiz')->row();
        if(!$old)
            $this->db->insert('exam_quiz', $exam_quiz);
        else if($old->edit_date<=$exam_quiz["edit_date"]) {
            $this->db->where('uuid', $exam_quiz["uuid"]);
            $this->db->update('exam_quiz', $exam_quiz);
        }
    }
    function save($params) {
        $question = $params["question"];
		$content = $params["content"];
        
		if($question["quiz_type"]=='MultipleChoice') {
			$content["answers"][intval($params["correct"])]["correct"] = true;
		} else if($question["quiz_type"]=='Matching') {
			foreach($content["column1"] as & $answer) {
				if(strpos($answer["image"],'tmp/')!==false) {
					$file = substr($answer["image"], 4);
					$answer["image"] = 'assets/' . $question["uuid"] . '/' . $file;
					$this->copy_assert($question["uuid"], $file);
				}
			}
			foreach($content["column2"] as & $answer) {
				if(strpos($answer["image"],'tmp/')!==false) {
					$file = substr($answer["image"], 4);
					$answer["image"] = 'assets/' . $question["uuid"] . '/' . $file;
					$this->copy_assert($question["uuid"], $file);
				}
			}
			$content["column1"] = array_values($content["column1"]);
			$content["column2"] = array_values($content["column2"]);
			$content["match"] = array_values($content["match"]);
		} else if($question["quiz_type"]=='FillInTheBlankEx' || $question["quiz_type"]=='MultipleChoiceText' || $question["quiz_type"]=='MultipleChoiceLine' || $question["quiz_type"]=='Correct') {
			$answers = $params["answers"];
			$content["answers"] = array();
			preg_match_all ("/<blank[^>]*data-id=['\"]?(\\d*)['\"]?[^>]*>(<\\/blank>)?/", stripslashes($content["detail"]["html"]), $matches);
			$content["detail"]["html"] = preg_replace("/<blank[^>]*>(<\\/blank>)?/"," <blank></blank> ",$content["detail"]["html"]);
			if(is_array($matches[1])) foreach($matches[1] as $id) {
				$answers[$id][intval($answers[$id]["correct"])]["correct"] = true;
				unset($answers[$id]["correct"]);
				$content["answers"][] = $answers[$id];
			}
		} else if($question["quiz_type"]=='WordBank') {
			preg_match_all("/<blank>([^<]*)<\\/blank>/",$content["detail"]["html"],$matches);
			if(is_array($matches[1])) foreach($matches[1] as $match) {
				$content["answers"]["correct"][] = $match;
			}
			if(is_array($content["answers"]["extra"])) foreach($content["answers"]["extra"] as $i => $word) {
				if(trim($word)=="")
					unset($content["answers"]["extra"][$i]);
			}
		} else if($question["quiz_type"]=='Sequence') {
			$content["answers"] = array_values($content["answers"]);
		}
		$question["quiz_content"] = serialize($content);

		if($params['quiz_obj_path'] != ''){
            $question['quiz_obj_path'] = $params['quiz_obj_path'];
		}
		if($question["id"]>0) {
			$this->db->set("updated_at","SYSDATE()",FALSE);
			$this->db->where("id", $question["id"]);
			$this->db->update("exam_quiz",$question);
		} else {
			$this->db->set("created_at","SYSDATE()",FALSE);
			$question["id"] = $this->db->insert("exam_quiz",$question);
		}

		return $question["id"];
    }

    function getQuizHistoryList($course_id,$user_id)
    {
       $query ="SELECT a.learner_name,
                       a.chapter_id,
                       a.user_id,
                       a.group_id,
                       b.title AS group_title,
                       b.id,
                       b.quiz_ids,
                       (select num from chapter_num where user_id=a.user_id and chapter_id=a.chapter_id) AS attempt_num,
                       (select AVG(mark1)from exam_quiz_history where group_id=a.group_id) AS result_mark    
                  FROM (SELECT DISTINCT(a.group_id) AS group_id,
                               a.chapter_id,
                               a.user_id,             
                               concat(c.first_name, '', c.last_name) AS learner_name
                          FROM exam_quiz_history a,user c 
                         WHERE a.user_id=$user_id AND a.chapter_id IN (SELECT id FROM chapter WHERE course_id=$course_id)
                           AND a.user_id = c.id) a, exam_quiz_group b
                 WHERE a.group_id=b.id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getQuizAnswerList($group_id, $user_id) {
        $this->db->select('*');
        $this->db->from("exam_quiz_history");        
        $this->db->where('group_id', $group_id);
        $this->db->where('user_id', $user_id);              
        $query = $this->db->get();

        return $query->result_array();
    }
}

?>
