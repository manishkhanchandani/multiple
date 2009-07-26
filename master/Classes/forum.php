<?php
class forum {
	private static $instance;
	public function __construct() {
		if(self::$instance) {
			return self::$instance;
		} else {
			self::$instance = $this;
		}
	}
	
	public $catLink=array();
	public $catLinkChild=array();
	
	public function categoryParentLink($catId, $postId) {
		if(!$this->catLink) $this->catLink = array();
		$sql = "select * from forum_comments where comment_id = '".$catId."' and post_id = '".$postId."'";
		$rs = @mysql_query($sql);
		if(!$rs) {
			throw new Exception(mysql_error());
		}
		if(mysql_num_rows($rs)>0) {
			$rec = mysql_fetch_array($rs);
			$catId = $rec['comment_id'];
			$pid = $rec['parent_id'];
			$category = '<a href="'.$_SERVER['PHP_SELF'].'&catId='.$catId.$this->qs.'">'.$rec['category'].'</a>';
			array_unshift($this->catLink,$category);
			$this->categoryParentLink($pid, $postId);	
		} else {
			$this->catLinkDisplay = '<a href="'.$_SERVER['PHP_SELF'].'&catId='.$catId.$this->qs.'">Home</a>';
			if($this->catLink) {
				foreach($this->catLink as $value) {
					$this->catLinkDisplay .= ' >> '.$value;
				}
				$this->catLinkDisplay = substr($this->catLinkDisplay,0);
			}
		}
	}
	
	public $tree;					// Clear the directory tree
	public $depth;					// Child level depth.
	public $top_level_on;			// What top-level category are we on?
	public $exclude = array();			// Define the exclusion array
	
	public function tree($CatId, $postId) {
		$this->tree = "";					
		$this->depth = 1;					
		$this->top_level_on = 1;			
		$this->exclude = array(0);	
		$this->tempTree = '';		
		$sql = "select * from forum_comments where parent_id = '".$CatId."' and post_id = '".$postId."'";
		$nav_query = @mysql_query($sql);
		if(!$nav_query) {
			throw new Exception(mysql_error());
		}
		while($nav_row = mysql_fetch_array($nav_query)) {
			$goOn = 1;			// Resets variable to allow us to continue building out the tree.
			for($x = 0; $x < count($this->exclude); $x++)		// Check to see if the new item has been used
			{
				if ( $this->exclude[$x] == $nav_row['comment_id'] )
				{
					$goOn = 0;
					break;	// Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
				}
			}
			if ( $goOn == 1 )
			{
				$this->tree .= "<div class=\"lilinks\"><a href=\"#\" class=\"alinks\">".$nav_row['comment_title'] . "</a> [Add]</div>";				// Process the main tree node
				array_push($this->exclude, $nav_row['comment_id']);		// Add to the exclusion list
				$this->tree .= $this->build_child($nav_row['comment_id'], $postId);		// Start the recursive function of building the child tree
			}
		}
	}
	public function build_child($oldID, $postId)			// Recursive function to get all of the children...unlimited depth
	{			
		$sql = "SELECT * FROM `forum_comments` WHERE parent_id='" . $oldID . "' and post_id = '".$postId."'";		
		$child_query = @mysql_query($sql);
		if(!$child_query) {
			throw new Exception(mysql_error());
		}
		while ($child = mysql_fetch_array($child_query))
		{
			if ( $child['category_id'] != $child['parent_id'] )
			{
				$tempTree .= "<div class=\"lilinks\">";
				for ( $c=0;$c<$this->depth;$c++ )			// Indent over so that there is distinction between levels
				{ 
					$tempTree .= "&nbsp;&nbsp;&nbsp;&nbsp;"; 
				}
				$tempTree .= "<a href=\"#\" class=\"alinks\">";
				$tempTree .= "- " . $child['comment_title'] . "</a>[Add]</div>";
				$this->depth++;		// Incriment depth b/c we're building this child's child tree  (complicated yet???)
				$tempTree .= $this->build_child($child['comment_id'], $postId);		// Add to the temporary local tree
				$this->depth--;		// Decrement depth b/c we're done building the child's child tree.
				array_push($this->exclude, $child['comment_id']);			// Add the item to the exclusion list
			}
		}
	 
		return $tempTree;
	}
}
?>