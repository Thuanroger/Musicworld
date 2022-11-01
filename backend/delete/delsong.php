<?php

include '../dal/Song.php';
 ?>
<?php
                                                         if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
                                                            $id=$_GET['id'];
                                                            $delete=new Song();
                                                            $delete->songId= $id;
                                                            $delete->flag=1;
                                                            $delete->updateSong1();
                                                            
                                                          if($delete->updateSong1()){
                                                        header("Location: /Eproject/backend/Admin.php?page=listsong");
                                                          }
                                                          }
                                                            ?>
