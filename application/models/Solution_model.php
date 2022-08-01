<?php

class Solution_model extends CI_Model {
	protected $_name = "solution";

    function categories($mid) {
        $sql = "SELECT e.code, e.name,d.points*SUM(c.points) points,COUNT(b.id) count,
        			SUM(b.points*d.points)*" . 5 . "/SUM(c.points*d.points) score
        		FROM test_member a
        			LEFT JOIN solution b ON b.member_id=a.id
                	LEFT JOIN question c ON b.question_id=c.id
        			LEFT JOIN test_range d ON d.schedule_id=a.schedule_id
        				AND LOCATE(d.category_code,c.category_code)=1   
                	LEFT JOIN test_category e ON c.subject_code=e.subject_code AND d.category_code=e.code
            	WHERE a.id=? AND c.type!='General'
            	GROUP BY d.id
        		ORDER BY e.code";
        $result = $this->query($sql, $mid)->fetchAll();
        $categories = array();
        if($result) foreach($result as $row) {
        	$categories[$row["code"]] = $row;
        }
        return $categories;
    }
    function points($mid) {
    	$sql = "SELECT LEFT(b.category_code,1) code,d.name name,SUM(a.points*c.points) score,SUM(b.points*c.points) full 
    			FROM solution a
                	LEFT JOIN question b ON a.question_id=b.id
                	LEFT JOIN test_range c ON LOCATE(c.category_code,b.category_code)=1
    					AND a.schedule_id=c.schedule_id
    				LEFT JOIN test_category d ON LEFT(b.category_code,1)=d.code
	            WHERE a.member_id=? AND b.type!='General'
	            GROUP BY LEFT(b.category_code,1)";
    	$result = $this->query($sql, $mid)->fetchAll();
    	$categories = array();
    	$full = 0;
    	$score = 0;
    	foreach($result as $row) {
    		$score += $row["score"];
    		$full += $row["full"];
    	}
    	if(floatval($full)>0)
    	foreach($result as $row) {
    		$categories[$row["code"]] = array("code"=>$row["code"],"name"=>$row["name"],"score"=>$row["score"] * 5 / $full);
    	}
    	return $categories;
    }
    function questions($mid) {
    	$sql = "SELECT b.*,a.content solution,a.id solution_id,a.attempts try,a.points solution_points,
    				LEFT(b.category_code,1) category_code
	            FROM solution a 
    				LEFT JOIN question b ON a.question_id=b.id
    	        WHERE a.member_id=?
    			ORDER BY b.category_code";
    	return $this->query($sql, $mid)->fetchAll();
    }
    /*function questions($member) {
        $sql = "SELECT b.*,a.content solution,a.id solution_id,a.attempts try,a.points solution_points
            FROM solution a LEFT JOIN question b ON a.uuid=b.uuid
            WHERE a.schedule_id=? AND a.member_id=? ORDER BY b.category_code";
        return $this->db->query($sql, array($member->schedule_id, $member->id))->result();
    }
    function all($filter) {
        if($filter[schedule])
            $this->db->where("a.schedule_id", $filter[schedule]);
        if($filter[mode])
            $this->db->where("b.mode", $filter[mode]);
        if(isset($filter[solved]))
            $this->db->where($filter[solved]?"a.points>":"a.points=",0,FALSE);
        $where = "";
        if (count($this->db->ar_where))
            $where .= "\nWHERE ";
        $where .= implode("\n", $this->db->ar_where);
        $sql = "SELECT b.*,a.content solution,a.id solution_id,a.attempts try,a.points solution_points,a.status
            FROM solution a LEFT JOIN question b ON a.uuid=b.uuid $where
            ORDER BY b.category_code";
        return $this->db->query($sql)->result();
    }
    function attempt($id) {
        $this->db->where(id, $id);
        $this->db->where("attempts > ", 0);
        $this->db->set(attempts, "attempts-1", FALSE);
        $this->db->update("solution");
    }
    function select($id) {
        $this->db->where("solution.id", $id);
        $this->db->join("question", "question.uuid=solution.uuid", "left");
        $this->db->select("question.*, solution.content solution", FALSE);
        return $this->db->get("solution")->row();
    }*/
    function solve($id, $solution) {
        $sql = "SELECT b.* FROM solution a LEFT JOIN question b ON a.question_id=b.id WHERE a.id=?";
        $question = $this->query($sql, $id)->fetch();

        srand($id);
        $question["content"] = Zend_Json::decode($question["content"]);
        $points = $this->checkup($question, $solution, TRUE);

        $data["content"] = Zend_Json::encode($solution);
        $data["solve_time"] = $this->expr("SYSDATE()");
        $data["points"] = $points;
        if($question["mode"]==AUTO)
            $data["status"] = 2;
        else
            $data["status"] = 1;
        $this->update($data, $this->quote("id=?", $id));
    }
    function check($id, $points) {
        $user = $this->session->userdata("user");
        $sql = "SELECT b.type,a.content,b.points FROM solution a LEFT JOIN question b ON a.uuid=b.uuid WHERE a.id=?";
        $solution = $this->db->query($sql, $id)->row();
        if($solution->type=="Translate") {
            $content = json_decode($solution->content);
            $content->points = $points;
            $this->db->set("content", json_encode($content));
            $marks = 0;
            if(count($points)) {
                foreach($points as $p)
                    $marks += $p;
                $marks = $solution->points * $marks / 5 / count($points);
                $this->db->set("points", $marks);
            }
        } else if($solution->type=="RecordVideo" || $solution->type=="RecordAudio") {
            $this->db->set("content", true);
            $this->db->set("points", $solution->points * min(max(0,$points),5)/5);
        }
        $this->db->where("id", $id);
        $this->db->set("status", 2);
        $this->db->set("checker_id", $user->id);
        $this->db->set("check_time", "CURRENT_TIMESTAMP()", FALSE);
        $this->db->update("solution");
        return $marks;
    }

    function checkup($question, $solution, $ignore_case = TRUE) {
        $points = 0;
        $content = $question["content"];
        if($solution!=null) {
            if($question["quiz_type"]=="MultipleChoice") {
                if($question["partial"]) {
                    $max_point = 0;
                    foreach($content["answers"] as $answer) {
                        if($max_point<$answer["points"])
                            $max_point = $answer["points"];
                    }
                    $points = $question["marks"] * $content["answers"][$solution]["points"] / $max_point;
                } else {
                    if($content["answers"][$solution]["correct"])
                        $points = $question["marks"];
                }
            } else if($question["quiz_type"]=="TrueFalse") {
                if($content["correct"]!= $solution["correct"]) {
					$points = 0;
				} else {
					if($question["partial"]) {
						$max_point = 0;
						foreach($content["answers"] as $answer) {
							if($answer["correct"])
								$max_point += $answer["points"];
						}
						if($solution["reason"]) foreach($solution["reason"] as $chk) {
							$points += $content["answers"][$chk]["points"];
						}
						$points = $question["marks"] * $points / $max_point;
					} else {
						$max_point = 0;
						foreach($content["answers"] as $answer) {
							if($answer["correct"])
								$max_point ++;
						}

						if($solution["reason"]) foreach($solution["reason"] as $chk) {
							if($content["answers"][$chk]["correct"]=="true")
								$points ++;
							else 
								$points --;
						}
						$points = $question["marks"] * $points / $max_point;
					}
				}
            } else if($question["quiz_type"]=="MultipleResponse") {
				if($question["partial"]) {
					$max_point = 0;
					foreach($content["answers"] as $answer) {
						if($answer["correct"])
							$max_point += $answer["points"];
					}
					foreach($solution as $chk) {
						$points += $content["answers"][$chk]["points"];
					}
					$points = $question["marks"] * $points / $max_point;
				} else {
					foreach($solution as $i=>$s) {
						if(strval($s)==="")
							unset($solution[$i]);
					}
					foreach($content["answers"] as $i=>$answer) {

                        /*if((!$answer["correct"])===(array_search($i,$solution)===FALSE)) {
							$points++;
						}*/
						$index = array_search($i,$solution);
                        if ($index === "FALSE") continue;
                        $points++;
					}

                    $correct_count = 0;
                    foreach($content["answers"] as $key => $value)
                        if ($value["correct"] == 'true') $correct_count++;

					$points = $question["marks"] * $points / count($content["answers"]);
				}
            } else if($question["quiz_type"]=="MultipleSwitch") {
				if($question["partial"]) {
                    $max_point = 0;
                    foreach($content["answers"] as $answer) {
                        if($answer["correct"])
                            $max_point += $answer["points"];
                    }
					foreach($solution as $i=>$chk) {
                        if($content["answers"][$i]["correct"]==$chk)
                            $points += $content["answers"][$i]["points"];
                    }
                    $points = $question["marks"] * $points / $max_point;
                } else {
                    /*if (is_object($solution)) {
                        $solution = json_decode(json_encode($solution), true);
                    }*/

                    foreach($content["answers"] as $i=>$answer) {
                        if(isset($solution[$i]) && $answer["correct"]==($solution[$i]==1))
                            $points++;
                    }
                    $points = $question["marks"] * $points / count($content["answers"]);
                }
            } else if($question["quiz_type"]=="FillInTheBlank") {
                $response = preg_replace("/[　\\t\\n]+/"," ",trim(strip_tags($solution)));
                if($question["partial"]) {
                    $max_point = 0;
                    foreach($content["answers"] as $answer) {
                        if($max_point<$answer["points"])
                            $max_point = $answer["points"];
                    }
                    foreach($content["answers"] as $answer) {
                        if(strcmp(preg_replace("/[　\\t\\n]+/"," ",trim(strip_tags($answer["html"]))),$response)==0) {
                            $points += $answer["points"];
                            break;
                        } else if(strcasecmp(preg_replace("/[　\\t\\n]+/"," ",trim(strip_tags($answer["html"]))),$response)==0) {
                            $points += $answer["points"] * ($ignore_case?1:0.5);
                            break;
                        }
                    }
                    $points = $question["marks"] * $points / $max_point;
                } else {
                    foreach($content["answers"] as $answer) {
                        if(strcmp(preg_replace("/[　\\t\\n]+/"," ",trim(strip_tags($answer["html"]))),$response)==0) {
                            $points = $question["marks"];
                            break;
                        } else if(strcasecmp(preg_replace("/[　\\t\\n]+/"," ",trim(strip_tags($answer["html"]))),$response)==0) {
                            $points = $question["marks"] * ($ignore_case?1:0.5);
                            break;
                        }
                    }
                }
            } else if($question["quiz_type"]=="Matching") {
                $correct = array();
                $response = array();
                foreach($content["answers"] as $answer) {
                    $correct[] = $answer["column1"] . "-" . $answer["column2"];
                }


                foreach($solution as $answer) {
                    $response[] = $answer["column1"] . "-" . $answer["column2"];
                }
                $points = $question["marks"] * (1-(count(array_diff($correct, $response))+count(array_diff($response,$correct)))/count($correct));
            } else if($question["quiz_type"]=="Sequence") {
            	$order = range(0,count($content["answers"])-1);
                srand($question[id]);
                shuffle($order);
                if($question["partial"]) {
                	$max_point = 0;
                	foreach($content["answers"] as $answer) {
                		$max_point += $answer["points"];
                	}
                	if($max_point==0) {
                		$max_point = count($content["answers"]);
                		foreach($order as $i=>$j) {
                			if($solution[$i]==$j)
                				$points ++;
                		}
                	} else {
	                	foreach($order as $i=>$j) {
	                		if($solution[$i]==$j)
	                			$points += $content["answers"][$j]["points"];
	                	}
                	}
                	$points = $question["marks"] * $points/$max_point;
                } else {
                	foreach($order as $i=>$j) {
                		if($solution[$i]==$j)
                			$points ++;
                	}
                	$points = $question["marks"] * $points/count($content["answers"]);
                }
            } else if($question["quiz_type"]=="Numeric") {
                $response = $solution;
                $correct = null;
                foreach($content["answers"] as $answer) {
                    if($answer["type"]=="between") {
                        if($solution>=$answer["from"] && $solution<=$answer["to"]) {
                            $correct = $answer;
                            break;
                        }
                    } else if($answer["type"]=="greaterThan") {
                        if($solution>$answer["value"]) {
                            $correct = $answer;
                            break;
                        }
                    } else if($answer["type"]=="greaterThanOrEqual") {
                        if($solution>=$answer["value"]) {
                            $correct = $answer;
                            break;
                        }
                    } else if($answer["type"]=="lessThan") {
                        if($solution<$answer["value"]) {
                            $correct = $answer;
                            break;
                        }
                    } else if($answer["type"]=="lessThanOrEqual") {
                        if($solution<=$answer["value"]) {
                            $correct = $answer;
                            break;
                        }
                    } else if($answer["type"]=="equal") {
                        if($solution==$answer["value"]) {
                            $correct = $answer;
                            break;
                        }
                    }
                }
                if($correct) {
                    if($question["partial"]) {
                        $max_point = 0;
                        foreach($content["answers"] as $answer) {
                            if($max_point<$answer["points"])
                                $max_point = $answer["points"];
                        }
                        $points = $question["marks"] * $correct["points"] / $max_point;
                    } else {
                        $points = $question["marks"];
                    }
                }
            } else if($question["quiz_type"]=="FillInTheBlankEx") {
                if($question["partial"]) {
					foreach($content["answers"] as $i => $answers) {
                        $correct = false;
                        $response = trim(preg_replace("/[　\\t\\n]+/"," ",$solution[$i]));
                        $max_point = 0;
                        foreach($answers as $answer) {
                            if($max_point<$answer["points"])
                                $max_point = $answer["points"];
                        }
                        foreach($answers as $answer) {
							if(intval($answer["points"])==0)
								continue;
                            if(strcmp(trim(preg_replace("/[　\\t\\n]+/"," ",$answer["html"])),$response)==0) {
                                $points += $question["marks"] * $answer["points"] / $max_point;
                                break;
                            } else if(strcasecmp(trim(preg_replace("/[　\\t\\n]+/"," ",$answer["html"])),$response)==0) {
                                $points += $question["marks"] * $answer["points"] / $max_point * ($ignore_case?1:0.5);
                                break;
                            }
                        }
                    }
                    $points /= count($content["answers"]);
                } else {
                    foreach($content["answers"] as $i => $answers) {
                        $correct = false;
                        $response = trim(preg_replace("/[　\\t\\n]+/"," ",$solution[$i]));
                        foreach($answers as $answer) {
                            if(strcmp(trim(preg_replace("/[　\\t\\n]+/"," ",$answer["html"])),$response)==0) {
                                $points += $question["marks"];
                                break;
                            } else if(strcasecmp(trim(preg_replace("/[　\\t\\n]+/"," ",$answer["html"])),$response)==0) {
                                $points += $question["marks"] * ($ignore_case?1:0.5);
                                break;
                            }
                        }
                    }
                    $points /= count($content["answers"]);
                }
            } else if($question["quiz_type"]=="Correct") {
                $correct = trim(strip_tags($content["detail"]["html"],"<blank>"));
                $i = 0;
                while(preg_match("/<blank><\\/blank>/",$correct)) {
                    $words = $content["answers"][$i];
                    foreach($words as $j=>$word) {
                        if($word["correct"]) {
                            $correct = preg_replace("/<blank><\\/blank>/", "<ins>" . trim($word["html"]) . "</ins>", $correct, 1);
                            break;
                        }
                    }
                    $i++;
                }
                $tags = array();
                $correct_html = $correct;
                while(preg_match("/<ins>([^<]+)<\\/ins>/",$correct_html,$matches)) {
                	$tags[] = $matches[1];
                	$correct_html = preg_replace("/<ins>([^<]+)<\\/ins>/", " ___TAG___ ", $correct_html, 1);
                }
                $correct_html = preg_replace("/[ \\n\\t]+/"," ",$correct_html);
                $tok = strtok($correct_html, " ");
                $words1 = array();
                $i = 0;
                while ($tok) {
                	if($tok=="___TAG___")
                		$tok = $tags[$i++];
                	$words1[] = $tok;
                	$tok = strtok(" ");
                }
                $solution = strip_tags($solution,"<a>");
                preg_match_all("/<a[^>]*>([^<]*)<\\/a>/", $solution,   $words2);
                $wrong = 0;
                for($i = 0;$i<count($words2[1]);$i++) {
                	if(strcmp(strip_tags(trim($words1[$i])),trim($words2[1][$i]))!=0)
                        $wrong++;
                    else if(strcasecmp(strip_tags(trim($words1[$i])),trim($words2[1][$i]))!=0)
                        $wrong += ($ignore_case?1:0.5);
                }
                $points = $question["marks"] * (1-min($wrong,count($content["answers"])) / count($content["answers"]));
            } else if($question["quiz_type"]=="MultipleChoiceText" || $question["quiz_type"]=="MultipleChoiceLine") {
                foreach($content["answers"] as $i => $answers) {
                    if($answers[$solution[$i]]["correct"])
                        $points++;
                }
                $points = $question["marks"] * $points / count($content["answers"]);
            } else if($question["quiz_type"]=="WordBank") {
                if($content["answers"]["correct"]==$solution)
                    $points = $question["marks"];
                else {
                    foreach($content["answers"]["correct"] as $i=>$answer) {
                        if(trim($answer)==trim($solution[$i]))
                            $points++;
                    }
                    $points = $question["marks"] * $points / count($content["answers"]["correct"]);
                }
            } else if($question["quiz_type"]=="Grouping") {
                if(is_object($solution))
                    $solution = get_object_vars($solution);
                $points = 0;
                $count = 0;
                
                foreach($content["answers"] as $i=>$answer) {
                    if($solution[$i]) {
                        $points += count(array_intersect($solution[$i],$answer["items"]));
	                    $count += count($answer["items"]);
                	}
                }
                $points = $question["marks"] * $points / $count;
            }
        }
        return max($points,0);
    }    
    function insert($data){
        $data['created_at'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert("exam_solution", $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function select($uid, $hid=0, $qid=0 ) {
        $this->db->where("user_id", $uid);
        if($hid > 0)
            $this->db->where("exam_history_id", $hid);
        if($qid > 0)
            $this->db->where("exam_quiz_id", $qid);
        return $this->db->get("exam_solution")->result_array();
    }
    function update($data, $id){
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where("id", $id);
        $rst = $this->db->update("exam_solution", $data);
        return $rst;
    }
}