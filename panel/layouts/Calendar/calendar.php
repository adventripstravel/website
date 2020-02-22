<?php
defined('_EXEC') or die;

// Calendar
$this->dependencies->add(['css', '{$path.plugins}fullcalendar/main.min.css']);
$this->dependencies->add(['js', '{$path.plugins}fullcalendar/main.min.js']);
$this->dependencies->add(['js', '{$path.plugins}fullcalendar/locales-all.min.js']);
$this->dependencies->add(['css', '{$path.plugins}fullcalendar/daygrid/main.min.css']);
$this->dependencies->add(['js', '{$path.plugins}fullcalendar/daygrid/main.min.js']);
$this->dependencies->add(['css', '{$path.plugins}fullcalendar/timegrid/main.min.css']);
$this->dependencies->add(['js', '{$path.plugins}fullcalendar/timegrid/main.min.js']);
$this->dependencies->add(['css', '{$path.plugins}fullcalendar/list/main.min.css']);
$this->dependencies->add(['js', '{$path.plugins}fullcalendar/list/main.min.js']);

// Page
// $this->dependencies->add(['js', '{$path.js}pages/calendar.js']);
$this->dependencies->add(['js', 'index.php?c=Calendar&m=script']);
?>

<div class="wrapper">
	<div class="container-fluid">
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<div class="page-title-box">
					<div class="btn-group float-right">
						<ol class="breadcrumb hide-phone p-0 m-0">
							<li class="breadcrumb-item">
								<a href="index.php">YachtMasters</a>
							</li>
							<li class="breadcrumb-item active">Calendario</li>
						</ol>
					</div>

					<h4 class="page-title">Calendario</h4>
				</div>
			</div>
		</div>
		<!-- end page title end breadcrumb -->

        <div class="row">
        	<div class="col-12">
        		<div class="card m-b-30">
        			<div class="card-body">
						<div class="row">
                            <div id='calendar' class="col-xl-12"></div>
                        </div>
                        <!-- end row -->
        			</div>
        		</div>
        	</div>
        	<!-- end col -->
        </div>
        <!-- end row -->
	</div>
	<!-- end container -->
</div>
<!-- end wrapper -->
