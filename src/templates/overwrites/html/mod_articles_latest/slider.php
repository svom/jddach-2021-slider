<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Load FieldsHelper
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

// Generate Random-ID to create unique identifier for Tiny-Slider-Setup
$randomId = substr(md5(uniqid()), 0, 12);;

if (!$list)
{
	return;
}

?>
<div class="latestarticleslider" id="latestarticleslider-<?php echo $randomId; ?>">
<?php foreach ($list as $item) : ?>
    <?php
        $item->jcfields = FieldsHelper::getFields('com_content.article', $item, true);

        foreach($item->jcfields as $jcfield)
        {
            $item->jcfields[$jcfield->name] = $jcfield;
        }
    ?>
	<div class="latestarticleslider__item" itemscope itemtype="https://schema.org/Article" style="background-color:<?php echo $item->jcfields['hintergrundfarbe']->value; ?>;color:<?php echo $item->jcfields['schriftfarbe']->value; ?>">
        <a href="<?php echo $item->link; ?>" class="latestarticleslider__item-upper" style="color:<?php echo $item->jcfields['schriftfarbe']->value; ?>">
            <h2 itemprop="name" class="latestarticleslider__item-upper-title"><?php echo $item->title; ?></h2>
            <?php
                $sizes = getimagesize(JURI::base() . json_decode($item->images)->image_intro);
            ?>
            <img class="latestarticleslider__item-upper-image" loading="lazy" width="<?php echo $sizes[0]; ?>" height="<?php echo $sizes[1]; ?>" src="<?php echo json_decode($item->images)->image_intro;?>" />
        </a>
        <div class="latestarticleslider__item-lower">
            <span class="latestarticleslider__item-lower-client">
                <?php echo $item->jcfields['kunde']->value; ?>
            </span>
            <span class="latestarticleslider__item-lower-client">
                <?php echo JFactory::getDate($item->jcfields['projektabschluss']->value)->format('m-Y'); ?>
            </span>
        </div>
	</div>
<?php endforeach; ?>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    tns({
      container: '#latestarticleslider-<?php echo $randomId; ?>',
      items: 1,
      slideBy: 1,
      autoplay: false,
      loop: true,
      nav: false,
      mouseDrag: true,
      controls: true,
      rewind: false,
      speed: 500,
      mode: 'gallery'
    });
  });
</script>