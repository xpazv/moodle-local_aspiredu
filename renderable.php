<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * AspirEDU Integration
 *
 * @package    local_aspiredu
 * @author     AspirEDU
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/report/log/classes/renderable.php');

class local_report_log_renderable extends report_log_renderable {

    /**
     * Setup table log.
     */
    public function setup_table() {
        $readers = $this->get_readers();

        $filter = new \stdClass();
        if (!empty($this->course)) {
            $filter->courseid = $this->course->id;
        } else {
            $filter->courseid = 0;
        }

        $filter->userid = $this->userid;
        $filter->modid = $this->modid;
        $filter->groupid = $this->get_selected_group();
        $filter->logreader = $readers[$this->selectedlogreader];
        $filter->edulevel = $this->edulevel;
        $filter->action = $this->action;
        $filter->date = $this->date;
        $filter->orderby = $this->order;
        $filter->origin = $this->origin;
        $filter->anonymous = 0;
        // If showing site_errors.
        if ('site_errors' === $this->modid) {
            $filter->siteerrors = true;
            $filter->modid = 0;
        }

        $this->tablelog = new report_log_table_log('report_log', $filter);
        $this->tablelog->define_baseurl($this->url);
        $this->tablelog->is_downloadable(true);
        $this->tablelog->show_download_buttons_at(array(TABLE_P_BOTTOM));
    }

}
