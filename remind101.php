<?php
/*
Plugin Name: Remind101 Widget
Plugin URI: 
Description: Include remind 101 announcements in a widget. To use this widget you will need a token from remind101. To find it, login to your account at remind101.com, click on Account then My Widget. Your key is the string of letters and numbers after token= up to but not including the quotation marks.
Author: Matt Young
Version: 0.1
Author URI: 
License: GPLv2 or later
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


class Remind101Widget extends WP_Widget {
	
	function Remind101Widget() {
		$widget_ops = array('classname' => 'Remind101Widget', 'description' => 'Displays recent messages from Remind101' );
		$this->WP_Widget('Remind101Widget', 'Remind101 Messages', $widget_ops);
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','remindToken' => '' ) );
		$title = $instance['title'];
		$remindToken = $instance['remindToken'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
			</label>
		</p><p>	
			<label for="<?php echo $this->get_field_id('remindToken'); ?>">
				Remind101 Token: <input class="widefat" id="<?php echo $this->get_field_id('remindToken'); ?>" name="<?php echo $this->get_field_name('remindToken'); ?>" type="text" value="<?php echo attribute_escape($remindToken); ?>" />
			</label>
		</p>
		<?php
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['remindToken'] = $new_instance['remindToken'];
		return $instance;
	}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		
		if (!empty($title)) echo $before_title . $title . $after_title;
		
		// WIDGET CODE GOES HERE
		echo "<h1>This is my new widget!</h1>";
		?>
		<script src="https://www.remind101.com/widgets/messages.js?token=<?= $instance['remindToken'] ?>" type="text/javascript"></script>
		<?
		echo $after_widget;	
	}
}

add_action( 'widgets_init', create_function('', 'return register_widget("Remind101Widget");') );?>