
<div class="table table-responsive table-bordered" style="line-height: 15px">
    <div  class="table table-responsive table-bordered" style="padding: 1px; overflow: hidden" width="100%">
        <table  class="table table-responsive table-bordered" style="padding: 1px; margin-bottom: 0; padding-bottom: 0" width="100%">

            <tr>
                <td colspan="2">
                    <img src="http://mediansagency.com/crm/image.php?src=beesklta.png&w=200&img=pic" style="display: none;" width="180">
                    <h1 style="display: inline-block;padding-left: 0; font-size: 42px; padding-top: 0; margin-top: 0">Beesklta - Express </h1>
                </td>
            </tr>
            <tr>

                <td width="50%">

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;" width="100">
                                <span>Shipper</span>
                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <p>Letoile</p>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;" width="130">
                                <span>Account number</span>
                            </td>
                            <td style="padding: 5px; font-size:13px;"> 50001</td>
                        </tr>
                    </table>

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;" width="100">
                                <span>Company</span>
                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <p>Letoile For Accessories</p>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;" width="50%">
                                <span>City:</span>
                                Cairo
                            </td>
                            <td style="padding: 5px; font-size:13px;" width="50%">
                                <span>Country:</span>
                                Egypt
                            </td>
                        </tr>
                    </table>
                    <div class="table table-responsive table-bordered" style="height: 2px" ></div>

                    <h4 style="margin: 5px 0;">Reciever information</h4>

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;" width="100">
                                <span>Name</span>:
                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <?= $customer->name; ?>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;">
                                <span>Phone 1 </span>:
                            </td >
                            <td style="padding: 5px; font-size:13px;">
                                <?= $customer->phone1; ?>
                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <span>Phone 2: </span>

                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <?= $customer->phone2; ?>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;">
                                <span>City</span>
                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <?= $customer->city; ?>
                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <span>Governorate</span>
                            </td>
                            <td style="padding: 5px; font-size:13px;">
                                <?= $customer->gov; ?>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;" width="20%">
                                <span>Address</span>
                            </td>
                            <td style="padding: 5px; font-size:13px;" width="80%">
                                <?= $customer->address1; ?>
                            </td>
                        </tr>
                    </table>

                    <table width="100%" class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding: 5px; font-size:13px;" width="20%">
                                <span>Notes</span>
                            </td>
                            <td style="padding: 5px; font-size:12px;" width="80%">
                                <p><?= $model->customer_notes; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>

                <td valign="top"  width="50%" style="vertical-align: sub;">

                    <table align="top" class="table table-responsive table-bordered">
                        <tr>
                            <td style="padding:0">
                                <table class="table table-responsive table-bordered">
                                    <tr><td >Order ID</td></tr>
                                    <tr><td ><?= $model->id; ?></td></tr>
                                </table>
                            </td>
                            <?php
                                echo '<td style="padding: 0">';
                                    echo '<table class="table table-responsive table-bordered">';
                                        echo '<tr><td >' . "test" . '</td></tr>';
                                        echo '<tr><td>' . "203" . '</td></tr>';
                                    echo '</table>';
                                echo '</td>';
                            ?>
                        </tr>
                        <tr >
                            <td colspan="[@colspan]" class="text-left">Shipping fees</td>
                            <td class="text-center"><?= ($model->shipping_fees == 0)? 'free' : $model->shipping_fees ?></td>
                        </tr>
                        <tr>
                            <td colspan="[@colspan]" class="text-left">Total cost</td>
                            <td class="text-center">199 EGP</td>
                        </tr>

                    </table>

                    <table style="margin-top: 21px;" width="100%" class="table table-responsive table-bordered">
                        <tr>
                            <td valign="top" style="padding: 10px; height: 95px; text-align: right;">
                                <p><span>توقيع المندوب</span>  </p>
                            </td>
                            <td valign="top" style="padding: 10px; height: 95px; text-align: right;">
                                <p><span>توقيع المستلم</span>  </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="padding: 10px; height: 95px; text-align: right;">
                                <p><span>تاريخ الشحن</span>  </p>
                            </td>
                            <td valign="top" style="padding: 10px; height: 95px; text-align: right;">
                                <p><span>تاريخ الاستلام</span>  </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="table table-responsive table-bordered" style="height: 3px"></div>
        <table width="100%" class="table table-responsive table-bordered">
            <tr>
                <td valign="top">
                    <h4  style="margin: 5px 0;">Policy and Conditions</h4>

                    <table width="100%" class="table table-responsive table-bordered">
                        <tr>
                            <td valign="top" style="font-size: 7px; width: 50%; max-width: 350px; line-height: 12px">
                                <p style="font-size: 12px"><b>Privacy:</b></p>
                                <p>Beesklta Express is doing Care for your personal information and we are dealing with them to not be used </p><p>outside the shipping process, it means that, the courier maybe be ask the receiver for his National ID. </p>
                                <p><b>Dealing with Courier</b></p>
                                <p>*You Can exchange the Place of delivery before the delivery date 12 Hours by minimum and in the same district. </p>
                                <p>*Delivery will be on your door in the agreed place and on the accurate time </p><p>according to your personal you inputs and your desire.</p>
                                <p>*We are very Picky with our Couriers, also we always give them trainees in high quality level about dealing </p><p>with customers and the emergencies and usually we track the quality in late delivery cases, </p><p>So if you have any escalation please back to us on Mobile: 01111792871</p>
                                <p>Why 65% of Cairo Citizens and about 85% from other Governorates prefer using Beesklta Express?</p>
                                <p>We offer you the lowest package for delivery in different sizes and different weights.</p>
                                <p>Beesklta Express is the fastest delivery on the best shipping lines in Cairo in Only 24 Working Hours.</p>
                                <p>Beesklta Express is the fastest delivery on the best shipping lines in all over Egypt in Only 72 Working Hours.</p>
                                <p><b>Returns and exchanges:</b></p>
                                <p>Customer must be sure of shipment`s safety before receiving and paying the Cash on delivery or shipping fees,</p><p> and Please for your safety don`t forget to ask about the sales check so you can exchange or return the shipment</p><p> later for the agreed reasons, or for any delivery mistake and this is the only case which </p><p>Beesklta Express is promising to accept your shipment back.</p>
                                <p><b>Complaints</b></p>
                                <p>For any Complaints or if you received any fault shipment or incomplete shipment please back to us within</p><p> the first 24 hours and while standing with our courier and be informed that the investigation</p><p> department can not investigate any case if you only have the sales check.</p>
                                <p><b>Dealing with Beesklta Express:</b></p>
                                <p>For shipping and contracting with Beesklta Express Please Call on 01111792871</p>



                            </td>
                            <td valign="top" dir="rtl" style="font-size: 7px; max-width: 350px">

                                <p style="font-size: 12px"><b>الخصوصية:</b></p>
                                <p>تهتم شركة بسكلتة اكسبريس جيداً ببيانات كل عميل الشخصية ويتم الحفاظ على معلوماتك في سرية تامة، بحيث لا يتم استغلالها خارج الشركة </p><p>أو خارج عملية الشحن مما يضطر المندوب للتحقق من هوية المستلم. </p>
                                <p><b>التعامل مع المندوب</b></p>
                                <p>*للعميل حق تغيير الموعد قبل ميعاد الإستلام في مدة أقلها 12 ساعة قبل استلام الطلب وفي مسافة لا تتعدى حدود نفس منطقة الطلب|</p><p> مثال: عنوان1: القاهرة، مدينة نصر، شارع عباس العقاد، عمارة 4، عنوان 2: القاهرة، مدينة نصر، الحي العاشر، شارع الشعراوي، عمارة 20 أمام أولاد رجب. </p>
                                <p>*يتم تسليم الطلب في المكان والموعد المُحددين والمُتفق عليهم مسبقاً مع العميل هاتفياً لضمان </p><p>*توصيل الشحنات في موعدها المتناسب مع طبيعة وظروف كل عميل وبحسب رغبته.</p>
                                <p>*يتم اختيار مندوب التوصيل بعناية وتقوم شركة "بسكلتة اكسبريس" بتدريب أعضائها على أعلى مستوى خدمة،</p><p> ويتم التأكد من قدرتهم التامة على التعامل مع المواقف الطارئة قبل توظيفهم، كما يتم محاسبة المندوب لذلك فى حالة التأخر أو الشكوى</p><p> يُرجى الإتصال على رقم تليفون 01111792871</p>
                                <p>لماذا يُفضل 65% من سكان القاهرة الكبرى و 85% من سكان المحافظات التعامل مع بسكلتة؟</p>
                                <p>تُقدم بسكلتة اكسبريس باقة أسعار تنافسية لشحن الأحجام المختلفة والأوزان المختلفة داخل مصر.</p>
                                <p>أسرع خدمة توصيل على أفضل خطوط الشحن داخل القاهرة الكبرى في مدة لا تتجاوز 24 ساعة عمل.</p>
                                <p>أسرع خدمة توصيل على أفضل خطوط الشحن داخل جميع محافظات الجمهورية في مدة لا تتجاوز 72 ساعة عمل</p><p> دون النظر إلى الأوضاع السياسية و الأمنية و عوامل الطقس التابع لها موقع التوصيل.</p>
                                <p><b>الاستبدال أو الاسترجاع</b></p>
                                <p>يحق للعميل التأكد من سلامة الطرد قبل رحيل المندوب، كما تُشدد الشركة على أحقية العميل </p><p>التأكد من وجود فاتورة الشحن والتوقيع عليها من فرد التوصيل قبل سداد القيمة المُستحقة، وعليه يتم الحفاظ على حق العميل في استبدال المنتج في حالة وجود </p><p> أي عيب أو خطأ أثناء عملية التوصيل وهي الحالة الوحيدة التي تتلزم فيها الشركة باستبدال المنتج أو سداد قيمته.</p>
                                <p><b>الشكاوى</b></p>
                                <p> يُرجى الرجوع للشركة في حال استقبالكم لأي طلب أو منتج غير كامل أو تالف في خلال يوم واحد من استلامه</p><p> وأثناء تواجد فرد التوصيل لديكم كما يُرجى العلم أنه لا يتم التحقيق في أى مشكلة إلا في حالة وجود فاتورة الشحن.</p>
                                <p><b>التعامل مع الشركة</b></p>
                                <p>لتوصيل أي شحنة وللتعامل مع شركة بسكلتة لخدمات التوصيل داخل القاهرة الكبرى والمحافظات يرجى الاتصال على رقم 01111792871</p>
                                <p>أو من خلال www.Beesklta.com / FB: /beeskeleta</p>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
</div>
