
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">All Orders Report</h3>
            </div>
            <div class="box-body">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple"><i class="fa fa-cubes"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Orders</span>
                            <span class="info-box-number"><?= $allOrdersCounter; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3><?= $totalAmount ?></h3>

                            <p>All Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <a href="/orders" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3><?= $totalAmount + $totalShippingFees ?><sup style="font-size: 20px">LE</sup></h3>

                            <p>All Orders COD</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="/orders" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3>Today's Order Report</h3>
            </div>
            <div class="box-body">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Today's Order</span>
                            <span class="info-box-number"><?= $todayOrdersCounter; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $todayTotalAmount  ?><sup style="font-size: 20px">LE</sup></h3>

                            <p>Today's Orders </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?= $todayTotalAmount + $todayShippingFees ?><sup style="font-size: 20px">LE</sup></h3>

                            <p>Today's Orders COD</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="/orders" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3>Top Project Report</h3>
            </div>
            <div class="box-body">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-navy"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Top Project</span>
                            <span class="info-box-number"><?= $customers ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3><?= '' ?> <sup style="font-size: 20px">LE</sup></h3>

                            <p>Project's Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <a href="/orders" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3><?= $todayTotalAmount + $todayShippingFees ?><sup style="font-size: 20px">LE</sup></h3>

                            <p>Today's Orders COD</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="/orders" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3>Customer Address</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Customers</span>
                            <span class="info-box-number"><?= $customers ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>
        </div>
    </div>
</div>
