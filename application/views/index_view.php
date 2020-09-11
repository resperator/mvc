<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - TaskSite</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand bg-light navigation-clean">
        <div class="container"><a class="navbar-brand" href="#">TaskSite</a>
            <div class="collapse navbar-collapse text-nowrap" id="navcol-1">
                <div class="btn-group" role="group">
				<a class="btn btn-primary <?if ($sort_type==1) {echo 'active';}?>" role="button" href="/index?action=sort_date">
					<i class="far fa-calendar-alt" data-toggle="tooltip" data-bs-tooltip="" title="Sort by date"></i>
					<i class="fas fa-long-arrow-alt-down <?if (($sort_descending!=true) or ($sort_type!=1)) {echo 'invisible';}?>" data-toggle="tooltip" data-bs-tooltip="" title="Sort descending" style="padding-bottom: 0px;margin-bottom: 0px;margin-right: -11px;padding-right: 0px;"></i>
				</a>
				<a class="btn btn-primary <?if ($sort_type==2) {echo 'active';}?>" role="button" href="/index?action=sort_name">
					<i class="far fa-user" data-toggle="tooltip" data-bs-tooltip="" title="Sort by name"></i>
					<i class="fas fa-long-arrow-alt-down <?if (($sort_descending!=true)or ($sort_type!=2))  {echo 'invisible';}?>" data-toggle="tooltip" data-bs-tooltip="" title="Sort descending" style="padding-bottom: 0px;margin-bottom: 0px;margin-right: -11px;padding-right: 0px;"></i>
				</a>
                <a class="btn btn-primary <?if ($sort_type==3) {echo 'active';}?>" role="button" href="/index?action=sort_mail">
					<i class="icon ion-email" data-toggle="tooltip" data-bs-tooltip="" title="Sort by mail"></i>
					<i class="fas fa-long-arrow-alt-down <?if (($sort_descending!=true)or ($sort_type!=3))  {echo 'invisible';}?>" data-toggle="tooltip" data-bs-tooltip="" title="Sort descending" style="padding-bottom: 0px;margin-bottom: 0px;margin-right: -11px;padding-right: 0px;"></i>
				</a>
				<a class="btn btn-primary <?if ($sort_type==4) {echo 'active';}?>" role="button" href="/index?action=sort_chk">
					<i class="icon ion-android-checkbox-outline" data-toggle="tooltip" data-bs-tooltip="" title="Sort by status"></i>
					<i class="fas fa-long-arrow-alt-down <?if (($sort_descending!=true)or ($sort_type!=4))  {echo 'invisible';}?>" data-toggle="tooltip" data-bs-tooltip="" title="Sort descending" style="padding-bottom: 0px;margin-bottom: 0px;margin-right: -11px;padding-right: 0px;"></i>
				</a>
			</div>
    <?
    if ($authorized==true)
    {
        print <<<END
        <a class="btn btn-primary ml-auto" role="button" href="/index?action=signout">Sign out</a>
END;
    }
    else
    {
        print <<<END
        <a class="btn btn-primary ml-auto" role="button" href="#modal_sign" data-toggle="modal">Sign In</a>
END;
    };
    ?>
                        
            </div>
        </div>
    </nav>
    <section class="showcase"></section>
    <section class="testimonials text-center bg-light">
        <div class="container text-right">
            <h2 class="text-center mb-5">Task list</h2><a class="btn btn-outline-primary" role="button" style="padding-top: 6px;margin-top: -36px;" href="/index?action=change&id=0"><i class="fas fa-plus" data-toggle="tooltip" data-bs-tooltip="" title="New task"></i></a>
            <div class="row" style="margin-top: 40px;">
                <div class="col-lg-4 <?if ($card_invisible[1]==true) {echo 'invisible';}?>">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="text-left" style="padding-top: 0px;color: #adafaa;margin-bottom: 0px;">#<?=$card_id[1]?><br></p>
                            </div>
                            <div class="col-1" style="padding-left: 0px;padding-right: 0px;">
                                <p class="text-left" style="padding-top: 0px;color: #adafaa;margin-bottom: 0px;"><a class="btn btn-sm <?if ($authorized!=true){echo "disabled";}?>" role="button" href="/index?action=change&id=<?=$card_id[1]?>" style="padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;"><i class="fa fa-edit <?if ($authorized!=true){echo "invisible";}?>" style="font-size: 23px;color: #007bff;"></i></a><br></p>
                            </div>
                            <div class="col text-right"><a class="btn <?if ($authorized!=true){echo "disabled";}?> btn-sm" role="button" href="/index?action=chk_change&id=<?=$card_id[1]?>&state=<?if ($card_chk[1]=='1'){echo "0";} else {echo "1";}?>" style="padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;"><i class="fa fa-<?if ($card_chk[1]=='1'){echo "check-";}?>square-o" style="font-size: 23px;color: #007bff;"></i></a></div>
                        </div>
                        <h3 class="text-center"><?=$card_name[1]?></h3>
                        <h6 class="text-center"><strong><?=$card_mail[1]?></strong><br></h6>
                        <p class="text-break text-center font-weight-light mb-0" style="max-height: 183px;min-height: 183px;">"<?=$card_text[1]?>"<br></p>
						<p class="text-info <?if ($card_edited_by_admin[1]!=true){echo 'invisible';}?>" style="margin-bottom: 0px;margin-right: -40px;font-size: 9px;">Edited by admin</p>
                    </div>
                </div>
                <div class="col-lg-4 <?if ($card_invisible[2]==true) {echo 'invisible';}?>">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="text-left" style="padding-top: 0px;color: #adafaa;margin-bottom: 0px;">#<?=$card_id[2]?><br></p>
                            </div>
                            <div class="col-1" style="padding-left: 0px;padding-right: 0px;">
                                <p class="text-left" style="padding-top: 0px;color: #adafaa;margin-bottom: 0px;"><a class="btn btn-sm <?if ($authorized!=true){echo "disabled";}?>" role="button" href="/index?action=change&id=<?=$card_id[2]?>" style="padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;"><i class="fa fa-edit <?if ($authorized!=true){echo "invisible";}?>" style="font-size: 23px;color: #007bff;"></i></a><br></p>
                            </div>
                            <div class="col text-right"><a class="btn <?if ($authorized!=true){echo "disabled";}?> btn-sm" role="button" href="/index?action=chk_change&id=<?=$card_id[2]?>&state=<?if ($card_chk[2]=='1'){echo "0";} else {echo "1";}?>" style="padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;"><i class="fa fa-<?if ($card_chk[2]=='1'){echo "check-";}?>square-o" style="font-size: 23px;color: #007bff;filter: sepia(0%);"></i></a></div>
                        </div>
                        <h3 class="text-center"><?=$card_name[2]?></h3>
                        <h6 class="text-center"><strong><?=$card_mail[2]?></strong><br></h6>
                        <p class="text-break text-center font-weight-light mb-0" style="max-height: 183px;min-height: 183px;">"<?=$card_text[2]?>"<br></p>
						<p class="text-info <?if ($card_edited_by_admin[2]!=true){echo 'invisible';}?>" style="margin-bottom: 0px;margin-right: -40px;font-size: 9px;">Edited by admin</p>
                    </div>
                </div>
                <div class="col-lg-4 <?if ($card_invisible[3]==true) {echo 'invisible';}?>">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="text-left" style="padding-top: 0px;color: #adafaa;margin-bottom: 0px;">#<?=$card_id[3]?><br></p>
                            </div>
                            <div class="col-1" style="padding-left: 0px;padding-right: 0px;">
                                <p class="text-left" style="padding-top: 0px;color: #adafaa;margin-bottom: 0px;"><a class="btn btn-sm <?if ($authorized!=true){echo "disabled";}?>" role="button" href="/index?action=change&id=<?=$card_id[3]?>" style="padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;"><i class="fa fa-edit <?if ($authorized!=true){echo "invisible";}?>" style="font-size: 23px;color: #007bff;"></i></a><br></p>
                            </div>
                            <div class="col text-right"><a class="btn <?if ($authorized!=true){echo "disabled";}?> btn-sm" role="button" href="/index?action=chk_change&id=<?=$card_id[3]?>&state=<?if ($card_chk[3]=='1'){echo "0";} else {echo "1";}?>" style="padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;"><i class="fa fa-<?if ($card_chk[3]=='1'){echo "check-";}?>square-o" style="font-size: 23px;color: #007bff;"></i></a></div> 
                        </div>
                        <h3 class="text-center"><?=$card_name[3]?></h3>
                        <h6 class="text-center"><strong><?=$card_mail[3]?></strong><br></h6>
                        <p class="text-break text-center font-weight-light mb-0" style="max-height: 183px;min-height: 183px;">"<?=$card_text[3]?>"<br></p>
						<p class="text-info <?if ($card_edited_by_admin[3]!=true){echo 'invisible';}?>" style="margin-bottom: 0px;margin-right: -40px;font-size: 9px;">Edited by admin</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center justify-content-xl-center" style="padding-top: 41px;">
            <ul class="pagination">
                <li class="page-item <? if ($page_index==1){echo 'disabled';}?>"><a class="page-link" href="/index?action=to_page&id=1" aria-label="First"><span aria-hidden="true">«</span></a></li>
                
                <?
                $i = 1;
                while ($i <= $page_count):
                $a='';
                if ($i==$page_index) {$a=' active';}
                echo '<li class="page-item'.$a.'"><a class="page-link" href="/index?action=to_page&id='.$i.'">'.$i.'</a></li>';
                $i++;
                endwhile;
                ?>
                
                <li class="page-item <? if ($page_index==$page_count){echo 'disabled';}?>"><a class="page-link" href="/index?action=to_page&id=<?=$page_count?>" aria-label="Last"><span aria-hidden="true">»</span></a></li>
            </ul>
        </nav>
    </section>
    <div class="toast fade text-left float-right hide" role="alert" data-delay="2000" id="toast_edit">
        <div class="toast-header"><i class="fa fa-check" style="color: #007bff;"></i><strong class="mr-auto">&nbsp;Success</strong><img class="mr-2"><button class="close ml-2 mb-1 close" data-dismiss="toast"><span aria-hidden="true">×</span></button></div>
        <div class="toast-body"
            role="alert">
            <p>Task editing completed successfully</p>
        </div>
    </div>		
    <div class="toast fade text-left float-right hide" role="alert" data-delay="2000" id="toast_new">
        <div class="toast-header"><i class="fa fa-check" style="color: #007bff;"></i><strong class="mr-auto">&nbsp;Success</strong><img class="mr-2"><button class="close ml-2 mb-1 close" data-dismiss="toast"><span aria-hidden="true">×</span></button></div>
        <div class="toast-body"
            role="alert">
            <p>New task has been successfully created</p>
        </div>
    </div>																							  																																																												 							   						 										  
    <footer class="footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 my-auto h-100 text-center text-lg-left">
                    <p class="text-muted small mb-4 mb-lg-0">© TaskSite 2020. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 my-auto h-100 text-center text-lg-right">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#"></a></li>
                        <li class="list-inline-item"><a href="#"></a></li>
                        <li class="list-inline-item"><a href="#"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal_edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="index?action=edit" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title"><? if($changing_task_id==0){echo 'New task';} else {echo 'Edit task';}?></h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <p>Please enter task details:</p>
                        <div class="form-row">
                            <div class="col-4">
                                <p>Name:</p>
                            </div>
                            <div class="col"><input class="form-control" type="text" required="" name="e_name" maxlength="30"  value="<?=$changing_task_name?>" style="width: 300px;"></div>
                        </div>
                        <div class="form-row">
                            <div class="col-4">
                                <p>Email:</p>
                            </div>
                            <div class="col"><input class="form-control" type="email" required="" name="e_mail" maxlength="30"  value="<?=$changing_task_mail?>" style="width: 300px;"></div>
                        </div>
                        <div class="form-row">
                            <div class="col-4">
                                <p>Task text:</p>
                            </div>
                            <div class="col"><input class="form-control" type="text" style="width: 300px;" maxlength="255" required="" name="e_text"  value="<?=$changing_task_text?>"></div>
                        </div><input class="form-control" type="hidden" name="e_id" value="<?=$changing_task_id?>"></div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save</button></div>
                </form>
            </div>
        </div>
    </div>																		
    <div class="modal visible" role="dialog" tabindex="-1" id="modal_sign">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="index?action=signin">
                    <div class="modal-header">
                        <h4 class="modal-title">Sign In</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <p>Please, enter you login and password:</p>
                        <div class="form-row">
                            <div class="col-4">
                                <p>Login:</p>
                            </div>
                            <div class="col"><input class="form-control" type="text" id="login" maxlength="10" required="" name="user"></div>
                        </div>
                        <div class="form-row">
						  
									 
                            <div class="col-4">
                                <p>Password:</p>
                            </div>
                            <div class="col"><input class="form-control" type="password" id="password" maxlength="10" required="" name="password"></div>
                        </div>
                        <div class="alert alert-danger <?if ($error_login!=true){echo "invisible";}?>" role="alert"><span><strong>Invalid&nbsp;</strong>login or password. Please, try again.</span></div>
                    </div>
																																	   
					  
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Login</button></div>
                </form>
            </div>
        </div>
    </div>																		   
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>

  
    <? //скрипт повторной авторизации
    if ($error_login==true)
    {
        print <<<END
        <script type="text/javascript">
        $(window).on('load',function(){
        $('#modal_sign').modal('show');
        });
        </script>
END;
    };
    ?>

<? //скрипт вызова модального окна изменения существующей задачи
    if ($changing_task_id>=0)
    {
        print <<<END
        <script type="text/javascript">
        $(window).on('load',function(){
        $('#modal_edit').modal('show');
        });
        </script>
END;
    };
    ?>

<? //Скрипт вывода тоста успешного редактирования
    if ($show_toast_edit_task==true)
    {
        print <<<END
        <script type="text/javascript">
        $(window).on('load',function(){
        $('#toast_edit').toast('show');
        });
        </script>
END;
    };
?>  
<? //Скрипт вывода тоста успешного создания
    if ($show_toast_new_task==true)
    {
        print <<<END
        <script type="text/javascript">
        $(window).on('load',function(){
        $('#toast_new').toast('show');
        });
        </script>
END;
    };
?>  

</body>

</html>