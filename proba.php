<?php
namespace alap;
use ggg\ddd\proba_trait;
use ggg\ddd\proba_trait2;

include 'proba_trait.php';
//defined( '_MOTTO' ) or die( 'Restricted access' );
class proba{

    public $gg=15;
    use proba_trait2;
    public function egyes(){
        echo 'egyes';
    }

}

//print_r($_POST['value']);
$e='hu';
echo <<<html
<script>
function ff(){
alert('gggggggggggg');
  window.clipboardData.setData('Text', 'gggggggggggggggg');
The David Walsh Blog is the best blog around!  MooTools FTW!

}
</script>
  <form    method="post" action="#" >
   <div class="form-group">
                         <label >en</label>
                         <textarea name="value[en]" class="form-control" rows="5">
                         <!--#value--> </textarea>
                    </div>
                <div class="form-group">
                         <label >$e</label>
                         <textarea name="value[$e]" class="form-control" rows="5">
                         <!--#value--> </textarea>
                    </div>

                </div>-->
                <div class="form-group">
                <label >Verse</label>
                    <input type="text" class="form-control"
                           name="verse" value="<!--#verse-->" >
                </div>
                    <input type="hidden" name="nev" value="<!--#nev-->"/>
                    <div class="form-group">
                        <button type="submit" name="task" value="save"
                                class="btn btn-primary btn-lg">Ment</button>
                        <button type="submit"  name="task" value="save_add"
                               class="btn btn-primary btn-lg" >Ment és új felvitel</button>
                        <button type="button" name="task" value="cancel" onclick="ff()"
                                class="btn btn-primary btn-lg"  >js</button>
                    </div>

                </div>

            </div>
    </form>





html;


/* $ff=new proba();
$ff->egyes_futtat();
$ff::egyes_futtat_stat();*/