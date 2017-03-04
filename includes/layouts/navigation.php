  	<ul class="subjects">
		<?php 	
			$subject_result=find_all_subjects();
		// use returned data if any.
		while($subjects=mysqli_fetch_assoc($subject_result)){
			//output data from each row

		?>
		<?php 
			echo "<li";
			if($subjects["id"] == $_GET['subject']){
				echo " class=\"selected\""; 
			}
			echo ">";
		?>
			<a href="manage_content.php?subject=<?php echo urlencode($subjects["id"]); ?>"><?php echo $subjects["menu_name"]."<br>"; ?> </a>
			<ul class="pages">
			<?php
			$subject_id=$subjects['id'];
			$page_result=find_pages_for_subject($subject_id);
				//use returned data
				while($page=mysqli_fetch_assoc($page_result)){


			?>
				<?php 
					echo "<li";
					if($page["id"] == $_GET['page']){
						echo " class=\"selected\""; 
					}
					echo ">";
				?>
					<a href="manage_content.php?page=<?php echo urlencode($page["id"]); ?>"><?php echo $page["menu_name"]; ?></a>
				</li>
			<?php } ?>
			<?php mysqli_free_result($page_result); ?>
			</ul>
		</li>

		<?php 
		}
		?>
		<?php mysqli_free_result($subject_result); ?>
	</ul>