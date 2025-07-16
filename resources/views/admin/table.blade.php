@extends('admin.master2') 
@section('content')

<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Heading</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                  
                    <div class="row gutters mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                          
                            <div class="table-container">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <form method="post" action="#">
                                        @csrf 
                                        <div class="row" style="display: flex;">
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fdate">From Date <span style="color:red">*</span></label>
                                                    <input type="date" required  class="form-control" id="fdate" name="fdate" placeholder="Enter date" />
                                                </div>
                                            </div>
                            
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="tdate">To Date <span style="color:red">*</span></label>
                                                    <input type="date" required class="form-control" id="tdate" name="tdate" placeholder="Enter date" />
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Store</label>
                                                    <select  class="form-control" id="store_id" name="store_id">
                                                        <option value="">Select</option>
                                                      
                                                        <option value="1">Tst</option>
                                                      
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <input type="hidden" value="2" name="filter">
                            
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6" style="margin-top: 22px;">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                  
                                                        <a href="#" class="btn btn-warning">Clear Filter</a>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                         
                             
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center; font-size: 18px;"> Heading</div>

                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                       
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Action</th>
                                                    <th>Order No.</th>
                                                    <th>Store Name</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Mobile</th>
                                                    <th>C Measuremnt No</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Delivery Date</th>
                                                    <th>Assign Date</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                <tr>
                                                  <td style="display: flex;"><span></span>&nbsp;&nbsp; 
                                                       <a class="btn btn-primary btn-sm" href="#">View </a>
                                                    
                                                        <a class="btn btn-secondary btn-sm" href="#" style="margin-left: 5px;">Image</a>

                                                      
                                                      
                                                    </td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                   <td>Data table</td>
                                                 
                                                
                                               </tr>
                                              
                                               
                                               
                                            </tbody>
                                           
                                        
                                        </table>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                  
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
