<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="<?=base_url()?>">Beranda</a></li>
                    <?php
                    $segment = $this->uri->segment_array();
                    $segments = count($segment);
                    $lastsegment = '';
                    if ($segments)
                    {
                        for ($i = 1; $i < $segments; $i++)
                        {
                    ?>
                            <li><a href="<?=site_url($lastsegment . $this->uri->slash_segment($i))?>"><?=humanize(ucwords($segment[$i]))?></a></li>
                    <?php
                            $lastsegment .= $this->uri->slash_segment($i);
                        }
                    }
                    ?>
                    <li class="active"><?=humanize(ucwords($segment[$i]))?></li>
                </ol>
            </div>
        </div>
    </div>