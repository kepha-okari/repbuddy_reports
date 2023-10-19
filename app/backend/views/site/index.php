<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
use miloschuman\highcharts\Highcharts;
?>
  <div id="w1" class="x_panel" >
  <div class="x_title">
  <h2><i class="fa fa-windows"></i> Dashboard</h2>
  <div class="clearfix"></div>
  </div>
  <div class="x_content">
  <div class="row">
    <div class="col-xs-12">
        <p></p>
    </div>
  </div>
  </div>
  </div>


      <div class="">
        <div class="row top_tiles">
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-caret-square-o-right "></i></div>
              <div class="count"><?= number_format(count($newRequests))?></div>
              <h3>All Merchants</h3>
              <p>Total Merchants onboarded</p>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-caret-square-o-right "></i></div>
              <div class="count"><?= number_format(count($approvedRequests))?></div>
              <h3>Deactivated Merchants</h3>
              <p> All Flagged Merchants</p>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-comments-o"></i></div>
              <div class="count"><?= number_format(count($settledRequests))?></div>
              <h3>Active Merchants</h3>
              <p>All Active Merchants</p>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
              <div class="count"><?= number_format(count($totalRequests))?></div>
              <h3>Active Support Tickets</h3>
              <p>All System Issues Raised</p>
            </div>
          </div>
    
        </div>


        <div class="row">
          <div class="col-md-4">
            <div class="x_panel">
              <div class="x_title">
                <h2>Recently Onboarded </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

              <?php foreach ($saccos as $sacco) { ?>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month"><?=date('M', strtotime($sacco->inserted_at))?></p>
                      <p class="day"><?=date('d', strtotime($sacco->inserted_at))?></p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#"><?= $sacco->name ?></a>
                      <p><?= $sacco->email ?></p>
                    </div>
                  </article>
              <?php }?>
              </div>
            </div>
          </div>


          <!-- <div class="col-md-4">
            <div class="x_panel">
              <div class="x_title">
                <h2>Top Profiles <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item One Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Two Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Two Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Two Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Three Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="x_panel">
              <div class="x_title">
                <h2>Top Profiles <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item One Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Two Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Two Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Two Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
                <article class="media event">
                  <a class="pull-left date">
                    <p class="month">April</p>
                    <p class="day">23</p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">Item Three Title</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </article>
              </div>
            </div>
          </div> -->

          <div class="col-md-8">
            <?= 
                Highcharts::widget([
                  'options' => [
                    'title' => ['text' => 'Sample Chart'],
                    'xAxis' => [
                        'categories' => ['Item 1', 'Item 2', 'Item 3']
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Sample Data']
                    ],
                    'series' => [
                        ['name' => 'Jane', 'data' => [1, 0, 4]],
                        ['name' => 'John', 'data' => [5, 7, 3]]
                    ]
                  ]
                ]);

            ?>
        </div>


    
        </div>
      </div>


