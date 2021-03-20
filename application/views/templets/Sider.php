<style>
        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: blue;
            color: white;
            cursor: pointer;
            padding: 15px;
            width: 50px;
            height: 50px;
            border-radius: 5px;
          }
          
          #myBtn:hover {
            background-color: #555;
        }
  
</style>

    </style>   
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" style="height:100%">
            <ul class="list-unstyled components">
            <?php if($this->session->userdata('login')!=0){?>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/">
                    <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
            <?php } ?>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user-graduate"></i>
                        Academics
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                     <?php if($this->SessionModel->check_authority("admit_student", TRUE)){ ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/Student_controller">Enroll Students</a> 
                            
                        </li>
                    <?php } 
                        if($this->SessionModel->check_authority("admission_cancel", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/admission_cancel_controller">Admission Cancellation</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("course_registration", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/course">Course Registration</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("exam_registration", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/exam">Exam Registration</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("attendance_sheet_generation", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/ATTENDANCE_MAIN">Generate Attendance Sheet</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("attendance", TRUE)){
                            ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Attendence">Submit Attendance</a> 
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("unit_test_marks_entry", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/unit">Unit Test Marks Entry</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("semester_internalmarks_entry", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/Sem_Controller">Internal Marks Entry</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("faculty_course_allotment", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/Facultytocourse">Faculty Course Alotment</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("semester_theorymarks_entry", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/Operator_Controller">Semester Theory Marks Entry Op1/Op2</a>
                        </li>
                    <?php }?>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-sliders-h"></i>
                        Administration
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                    <?php
                        if($this->SessionModel->check_authority("course_management", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/Cocontroller">Add Course</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("add_semester", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/Semcontroller">Add Semester</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("add_scheme", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/Schmecontro">Add Scheme</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("add_department", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/Department">Add/Remove Department</a>
                        </li>
                    <?php }?>
                    </ul>
                </li>
                <li>
                    <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Reports
                    </a>
                    <ul class="collapse list-unstyled" id="reportSubmenu">
                    <?php
                        if($this->SessionModel->check_authority("teachers_list", TRUE)){
                    ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/Teacher">Teachers List</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("course_wise_registration_list", TRUE)){
                            ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/course_list">Course Wise Registration List</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("student_admission_list", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/info">Department Wise Student Admission List</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("marksheet_report", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/marksheet_report">Marksheet</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("unit_test_report", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/Unit_Report">Unit Test Report</a>
                        </li>
                        <?php } 
                        if($this->SessionModel->check_authority("students_report", TRUE)){
                    ?>
                        <li>
                        <a href="<?php echo site_url(); ?>/">Student Report</a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if($this->SessionModel->check_authority("add_user", TRUE)){?>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/Signup">
                    <i class="fas fa-user-plus"></i>
                        Add faculty
                    </a>
                </li>
                
                <?php }
                    if($this->SessionModel->check_authority("add_messageoftheday", TRUE)){?>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/messageoftheday">
                    <i class="fas fa-envelope"></i>
                        Message of the day
                    </a>
                </li>
                <?php } if($this->SessionModel->check_authority("add_notice", TRUE)){ ?>
                <li>
                    <a href="<?php echo site_url(); ?>/notice">
                    <i class="fas fa-exclamation-triangle"></i>
                        Notice
                    </a>
                </li>
                <?php } if($this->SessionModel->check_authority("accesscontrol_management", TRUE)){ ?>
                <li>
                    <a href="<?php echo site_url(); ?>/accesscontrol">
                    <i class="fas fa-gamepad"></i>
                        Access cocontroller
                    </a>
                </li>
                <?php }?>
                <li>
                    <a href="#">
                    <i class="fas fa-phone"></i>
                        Contact Us
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fas fa-users"></i>
                        About Us
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li>
                    
                </li>
                <li>
                   
                </li>
            </ul>
        </div>
        </nav>