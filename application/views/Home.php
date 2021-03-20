<div class="wrapper">
    <div class="upper" id="upper">

        <div class="mod">
        <i class="fas fa-envelope-open"></i>&nbsp;&nbsp;</i><label for="">Message of the day</label>
                <marquee behavior="" direction=""><?php echo $message_oftheday; ?></marquee>
        </div>
          <!-- <div class="upper">  -->              
            <div class="notice" >
                <h3 class="noticeBoard">Notice</h3>
                <br>
                <button class="noticetablink" onclick="openNotice('noticeGeneral', this,'#ffbb99')" id="noticeDefaultOpen">General</button>
                <button class="noticetablink" onclick="openNotice('noticeStudent', this, '#99ddff')">Student</button>
                <button class="noticetablink" onclick="openNotice('noticeFaculty', this, '#adebad')">Faculty</button>
                <div id="noticeGeneral" class="noticetabcontent">
                  <?php foreach ($notice_general as $key => $value) {
                            echo "<h1 class='noticeTitle'><b>".$value->notice_title."</b></h1>";
                            echo "<p class='noticeData'>".$value->notice_description."</p>";
                        }    
                    ?>
                </div>

                <div id="noticeStudent" class="noticetabcontent" >
                  <?php foreach ($notice_student as $key => $value) {
                            echo "<h1 class='noticeTitle'><b>".$value->notice_title."</b></h1>";
                            echo "<p class='noticeData'>".$value->notice_description."</p>";
                        }    
                    ?>
                </div>

                <div id="noticeFaculty" class="noticetabcontent">
                  <?php foreach ($notice_employee as $key => $value) {
                            echo "<h1 class='noticeTitle'><b>".$value->notice_title."</b></h1>";
                            echo "<p class='noticeData'>".$value->notice_description."</p>";
                        }    
                    ?>
                </div>
            </div>
       <!--  </div> -->
                        <div class="sChart">
                            <br><br>
                            <h3>Student</h3>
                            <div class="sGender">
                                <canvas id="stuGen"></canvas>
                            </div>
                            <div class="sCategory">
                                <canvas id="stuCat"></canvas>
                            </div>
                        </div>
                        <div class="sChart2">
                            <br>
                            <div class="sPf">
                                <canvas id="stuPF"></canvas>
                            </div>
                            <div class="sAtten">
                                <canvas id="stuAtt"></canvas>
                            </div>
                        </div>
                        <div class="eChart">
                            <br><br><br>
                            <h3>Employee</h3>
                            <div class="eGender">
                                <canvas id="empGen"></canvas>
                            </div>
                            <div class="eDepart">
                                <canvas id="empDep"></canvas>
                            </div>
                        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/home.js"></script>
        <script>
                var ctx = document.getElementById("stuGen").getContext('2d');
        var myChart= new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        <?php foreach ($genderwise_students as $key => $value) { 
                                echo $value->male_cnt . ',' .$value->female_cnt;
                        }    
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    label: 'Genderwise Student'
                }],
                labels: [
                    'Male',
                    'Female'
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Gender wise Student'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });


        // Student category chart
        var abc = document.getElementById("stuCat").getContext('2d');
        var myChart2 = new Chart(abc, {
            type: 'bar',
            data: {
                        
                labels: [
                    
                    <?php foreach ($castwise_students as $key => $value) { 
                                foreach ($value as $ke => $val) { 
                                    echo '"'.$ke.'",';
                                }
                            }    
                    ?>
                    
                ],
                datasets: [{
                    label: 'No of students',
                    data: [
                        
                    <?php foreach ($castwise_students as $key => $value) { 
                                foreach ($value as $ke => $val) { 
                                    echo $val . ',';
                                }
                            }    
                    ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        //Sudent pass and fail
        var pqr = document.getElementById("stuPF").getContext('2d');
        var myChart3 = new Chart(pqr, {
            type: 'horizontalBar',
            data: {
                labels: ["Pass", "Fail"],
                datasets: [{
                    label: 'Students Result',
                    data: [
                        <?php foreach ($students_pass_fail as $key => $value) { 
                                    echo $value->pass . ',' . $value->fail;
                            }    
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        //Student attendance
        var lmn = document.getElementById("stuAtt").getContext('2d');
        var myChart4 = new Chart(lmn, {
            type: 'line',
            data: {
                labels: [
                    
                    <?php foreach ($attandance_students as $key => $value) { 
                                foreach ($value as $ke => $val) { 
                                    echo '"'.$ke.'",';
                                }
                            }    
                    ?>
                    
                ],
                datasets: [{
                    label: 'Student attendance in percentage',
                    data: [    
                    <?php foreach ($attandance_students as $key => $value) { 
                                foreach ($value as $ke => $val) { 
                                    echo $val . ',';
                                }
                            }    
                    ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        //Employee gender
        var zyx = document.getElementById("empGen").getContext('2d');
        var myChart5= new Chart(zyx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        <?php foreach ($genderwise_employee as $key => $value) { 
                                echo $value->male_cnt . ',' .$value->female_cnt;
                                }    
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    label: 'Gender wise Employees'
                }],
                labels: [
                    'Male',
                    'Female'
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Gender wise Employees'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

        //Radar graph of employee

        var opq = document.getElementById("empDep").getContext('2d');
        var myChart6= new Chart(opq, {
            type: 'radar',
            data: {
                datasets: [{
                    data: [
                        <?php foreach ($deptwise_employee as $key => $value) {
                                echo $value->count.',';
                            }    
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    label: 'Department wise Employees'
                }],
                labels: [
                    <?php foreach ($deptwise_employee as $key => $value) {
                                echo '"'.$value->dept_initial.'",';
                            }    
                    ?>
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Number of Employees'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
        </script>

        <script type="text/javascript">jQuery(document).ready(function () {
$(function() {
	$('.noticeModalLink').click(function() {
		$('#NoticeModal').modal('show')
		.find('#NoticeModalContent')
		.load($(this).attr('data-value'));
	});
});
$('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide'); 
        }
    });
});
jQuery('#NoticeModal').modal({"show":false});
$('#w0').fullCalendar({"fixedWeekCount":false,"weekNumbers":true,"editable":true,"eventLimit":true,"eventLimitText":"more Events","header":{"center":"title","left":"prev,next today","right":"month,agendaWeek,agendaDay"},"eventClick":		function(event, jsEvent, view) {
		    $('.fc-event').on('click', function (e) {
			$('.fc-event').not(this).popover('hide');
		    });
		},"eventRender":		function (event, element) {
			var start_time = moment(event.start).format("DD-MM-YYYY, h:mm:ss a");
		    	var end_time = moment(event.end).format("DD-MM-YYYY, h:mm:ss a");

			element.clickover({
		            title: event.title,
		            placement: 'top',
		            html: true,
			    global_close: true,
			    container: 'body',
		            content: "<table class='table'><tr><th> Event Detail : </th><td>" + event.description + " </td></tr><tr><th> Event Type : </th><td>" + event.event_type + "</td></tr><tr><th> Start Time : </t><td>" + start_time + "</td></tr><tr><th> End Time : </th><td>" + end_time + "</td></tr></table>"
        		});
               },"contentHeight":380,"timeFormat":"hh(:mm) A","events":"/EduSec-EduSec-e90fa70/index.php?r=dashboard%2Fevents%2Fview-events"});
});</script>

    </div>
</div>
