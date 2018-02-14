<?php 

class Course_model extends CI_Model {
	const WG_COURSE_TABLE 		= 'wg_course';

	public function __construct() {
		parent::__construct();
		$this->DB = $this->load->database('default', true);
	}

	/**
	 * [getBasicInfo description]
	 * @param  array   $where  [筛选条件]
	 * @param  integer $offset [分页]
	 * @param  integer $limit  [条数]
	 * @param  string  $order  [排序方式]
	 * @return [array]          [description]
	 */
	public function getBasicInfo($where = array(),$offset= 0,$limit=0, $order='id desc')
	{
		$result = array();
		$this->DB->from(self::WG_COURSE_TABLE);
		if (!empty($where)) {
			$this->DB->where($where);
		}

		$this->DB->where("flag >", 0);
		if ($limit) {
			$this->DB->limit($limit, $offset);
		}
		$this->DB->order_by($order);
		$query = $this->DB->get();
		if ($query && $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;	
	}

	/**
	 * 添加课程信息
	 * @param array $data [description]
	 */
	public function addCourseInfo($data = array())
	{
		$result = array();

 		$detailData = array(
			'title'      => $data['title'],
			'desc'		 => $data['desc'],
			'createtime' => date('Y-m-d H:i:s'),
			'modifytime' => date('Y-m-d H:i:s'),
			'course_id' => $data['course_id'],
			'thumb'		 => $data['thumb'],
			'flag'       => 1
		);
		$this->DB->insert(self::WG_COURSE_TABLE, $detailData);
		if (!$this->DB->affected_rows()) {
			return false;
		}
		if($result['insertId'] = $this->DB->insert_id()){
			$result['status'] = true;
		}
		return $result;
	}

	/**
	 * 更新课程信息
	 * @param  integer $course_id [更新的课程 id]
	 * @param  array   $data       [要更新的字段数据]
	 * @return [boolean]              [返回更新成功、失败]
	 */
	public function updateCourseInfo($course_id = 0,$data = array())
	{
		if(!$course_id){
			return false;
		}

		$this->DB->where('id',$course_id);
		$this->DB->update(self::WG_COURSE_TABLE, $data);

		if ($this->DB->affected_rows() <= 0) {
			return false;
		}

		return true;
	}

	/**
	 * 删除课程信息
	 * 注意：不去删除课程信息，只是将flag改为-1（直接删除的话，就找不回来了）
	 * @param  integer $course_id [课程id]
	 * @return [Boolean]              [删除成功、失败]
	 */
	public function deleteCourseInfo($course_id = 0)
	{
		if(!$course_id){
			return false;
		}

		$data['flag'] = -1;
		$this->DB->where('id',$course_id);
		$this->DB->update(self::WG_COURSE_TABLE, $data);

		if ($this->DB->affected_rows() <= 0) {
			return false;
		}

		return true;
	}

}
 ?>