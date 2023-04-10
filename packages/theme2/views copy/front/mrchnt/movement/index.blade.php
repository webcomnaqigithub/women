@extends('layouts.mrchnt.layout')
@section('title') الحركات المالية @endsection
@section('movements')
<div  >
    <div class="row">
       <div class="col-6">
          <h4>الحركات المالية</h4>
       </div>
       <div class="col-6 add_Products">
          <button class="button-Products-new">
          سحب الأرباح
          </button>
       </div>
    </div>
    <div class="tab_orders">
       <div class="row">
          <div class="col">
             <div class="tabs_container">
                <ul class="tabs d-flex  	    align-items-md-center justify-content-center">
                   <li class="tab active" data-active-tab="tab_movements_All"><span>الكل</span></li>
                   <li class="tab" data-active-tab="tab_movements_Processing"><span>قيد المعالجة</span></li>
                   <li class="tab" data-active-tab="tab_movements_deposit"><span>إيداع</span></li>
                   <li class="tab" data-active-tab="tab_movements_pull"><span>سحب</span></li>
                </ul>
             </div>
          </div>
       </div>
       <div class="row mx-1 mt-n13">
          <div id="tab_movements_All" class="tab_container active">
             <div class="row movements_col">
                <div class="col-6 details_user_movements"  >
                   <div class="icon-request-pull">
                      <svg id="setting" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <path id="Vector" d="M0,7v5.77c0,2.12,0,2.12,2,3.47l5.5,3.18a3.3,3.3,0,0,0,3,0L16,16.24c2-1.35,2-1.35,2-3.46V7c0-2.11,0-2.11-2-3.46L10.5.36a3.3,3.3,0,0,0-3,0L2,3.54C0,4.89,0,4.89,0,7Z" transform="translate(3 2.11)" fill="none" stroke="#f78831" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-2" data-name="Vector" d="M6,3A3,3,0,1,1,3,0,3,3,0,0,1,6,3Z" transform="translate(9 9)" fill="none" stroke="#f78831" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                      </svg>
                   </div>
                   <div class="details_movements">
                      <div class="movements_type">طلب سحب رصيد</div>
                      <div class="movements_number">#437952</div>
                      <div class="movements_price_request">$500</div>
                   </div>
                </div>
                <div class="col-6 details_button_movements"  >
                   <div class="movements-date-time">
                      <i class="fa fa-calendar"></i> 
                      <span>17/02/2022</span> 
                      <span class="pr-b">AM10:30</span>
                   </div>
                   <div class="button-movements">
                      <button>
                      تفاصيل
                      </button>
                   </div>
                </div>
             </div>
             <div class="row movements_col">
                <div class="col-6 details_user_movements"  >
                   <div class="icon-pull">
                      <svg id="arrow-up" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <path id="Vector" d="M12.14,6.07,6.07,0,0,6.07" transform="translate(5.93 3.5)" fill="none" stroke="#bf1f2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-2" data-name="Vector" d="M0,16.83V0" transform="translate(12 3.67)" fill="none" stroke="#bf1f2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" transform="translate(24 24) rotate(180)" fill="none" opacity="0"/>
                      </svg>
                   </div>
                   <div class="details_movements">
                      <div class="movements_type"> سحب رصيد</div>
                      <div class="movements_number">#437952</div>
                      <div class="movements_price_pull">$500</div>
                   </div>
                </div>
                <div class="col-6 details_button_movements"  >
                   <div class="movements-date-time">
                      <i class="fa fa-calendar"></i> 
                      <span>17/02/2022</span> 
                      <span class="pr-b">AM10:30</span>
                   </div>
                   <div class="button-movements">
                      <button>
                      تفاصيل
                      </button>
                   </div>
                </div>
             </div>
             <div class="row movements_col">
                <div class="col-6 details_user_movements"  >
                   <div class="icon-deposit">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <g id="vuesax_linear_arrow-down" data-name="vuesax/linear/arrow-down" transform="translate(-108 -252)">
                            <g id="arrow-down">
                               <path id="Vector" d="M12.14,0,6.07,6.07,0,0" transform="translate(113.93 266.43)" fill="#fff" stroke="#028c59" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                               <path id="Vector-2" data-name="Vector" d="M0,0V16.83" transform="translate(120 255.5)" fill="#fff" stroke="#028c59" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                               <path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" transform="translate(132 276) rotate(180)" fill="#fff" opacity="0"/>
                            </g>
                         </g>
                      </svg>
                   </div>
                   <div class="details_movements">
                      <div class="movements_type"> بيع</div>
                      <div class="movements_number">#437952</div>
                      <div class="movements_price_deposit">$500</div>
                   </div>
                </div>
                <div class="col-6 details_button_movements"  >
                   <div class="movements-date-time">
                      <i class="fa fa-calendar"></i> 
                      <span>17/02/2022</span> 
                      <span class="pr-b">AM10:30</span>
                   </div>
                   <div class="button-movements">
                      <button>
                      تفاصيل
                      </button>
                   </div>
                </div>
             </div>
          </div>
          <div id="tab_movements_Processing" class="tab_container">
             <div class="row movements_col">
                <div class="col-6 details_user_movements"  >
                   <div class="icon-request-pull">
                      <svg id="setting" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <path id="Vector" d="M0,7v5.77c0,2.12,0,2.12,2,3.47l5.5,3.18a3.3,3.3,0,0,0,3,0L16,16.24c2-1.35,2-1.35,2-3.46V7c0-2.11,0-2.11-2-3.46L10.5.36a3.3,3.3,0,0,0-3,0L2,3.54C0,4.89,0,4.89,0,7Z" transform="translate(3 2.11)" fill="none" stroke="#f78831" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-2" data-name="Vector" d="M6,3A3,3,0,1,1,3,0,3,3,0,0,1,6,3Z" transform="translate(9 9)" fill="none" stroke="#f78831" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                      </svg>
                   </div>
                   <div class="details_movements">
                      <div class="movements_type">طلب سحب رصيد</div>
                      <div class="movements_number">#437952</div>
                      <div class="movements_price_request">$500</div>
                   </div>
                </div>
                <div class="col-6 details_button_movements"  >
                   <div class="movements-date-time">
                      <i class="fa fa-calendar"></i> 
                      <span>17/02/2022</span> 
                      <span class="pr-b">AM10:30</span>
                   </div>
                   <div class="button-movements">
                      <button>
                      تفاصيل
                      </button>
                   </div>
                </div>
             </div>
          </div>
          <div id="tab_movements_deposit" class="tab_container">
             <div class="row movements_col">
                <div class="col-6 details_user_movements"  >
                   <div class="icon-deposit">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <g id="vuesax_linear_arrow-down" data-name="vuesax/linear/arrow-down" transform="translate(-108 -252)">
                            <g id="arrow-down">
                               <path id="Vector" d="M12.14,0,6.07,6.07,0,0" transform="translate(113.93 266.43)" fill="#fff" stroke="#028c59" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                               <path id="Vector-2" data-name="Vector" d="M0,0V16.83" transform="translate(120 255.5)" fill="#fff" stroke="#028c59" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                               <path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" transform="translate(132 276) rotate(180)" fill="#fff" opacity="0"/>
                            </g>
                         </g>
                      </svg>
                   </div>
                   <div class="details_movements">
                      <div class="movements_type"> بيع</div>
                      <div class="movements_number">#437952</div>
                      <div class="movements_price_deposit">$500</div>
                   </div>
                </div>
                <div class="col-6 details_button_movements"  >
                   <div class="movements-date-time">
                      <i class="fa fa-calendar"></i> 
                      <span>17/02/2022</span> 
                      <span class="pr-b">AM10:30</span>
                   </div>
                   <div class="button-movements">
                      <button>
                      تفاصيل
                      </button>
                   </div>
                </div>
             </div>
          </div>
          <div id="tab_movements_pull" class="tab_container">
             <div class="row movements_col">
                <div class="col-6 details_user_movements"  >
                   <div class="icon-pull">
                      <svg id="arrow-up" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <path id="Vector" d="M12.14,6.07,6.07,0,0,6.07" transform="translate(5.93 3.5)" fill="none" stroke="#bf1f2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-2" data-name="Vector" d="M0,16.83V0" transform="translate(12 3.67)" fill="none" stroke="#bf1f2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                         <path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" transform="translate(24 24) rotate(180)" fill="none" opacity="0"/>
                      </svg>
                   </div>
                   <div class="details_movements">
                      <div class="movements_type"> سحب رصيد</div>
                      <div class="movements_number">#437952</div>
                      <div class="movements_price_pull">$500</div>
                   </div>
                </div>
                <div class="col-6 details_button_movements"  >
                   <div class="movements-date-time">
                      <i class="fa fa-calendar"></i> 
                      <span>17/02/2022</span> 
                      <span class="pr-b">AM10:30</span>
                   </div>
                   <div class="button-movements">
                      <button>
                      تفاصيل
                      </button>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection