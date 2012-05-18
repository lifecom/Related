<?php

/* ---------------------------------------------------------------------------
 * @Plugin Name: Related
 * @Description: Plugin to display a list of related topics
 * @Author URI: http://chiliec.ru
 * @LiveStreet Version: 0.5.1
 * @Plugin Version:	1.0.0
 * @Taken From: PSNet Similarpopup plugin
 * ----------------------------------------------------------------------------
 */

class PluginRelated_HookRelated extends Hook {

  public function RegisterHook () {
    $this -> AddHook ('template_topic_show_end', 'TopicShowSimilar');
  }
	
  // ---

  public function TopicShowSimilar ($Vars) {
    $oTopic = $Vars ['topic'];
    if (!$oTopic) return false;
    
    $aSimilarTopics = $this -> PluginRelated_ModuleRelated_Similarpopup_GetSimilarTopicsByTopic (
      $oTopic,
      Config::Get ('plugin.related.Show_Topics_Count'),
      Config::Get ('plugin.related.Order_By'),
      Config::Get ('plugin.related.Order_By_Direction')
      
    );
    $this -> Viewer_Assign ('aSimilarTopics', $aSimilarTopics);
    
    return $this -> Viewer_Fetch (Plugin::GetTemplatePath (__CLASS__) . 'related.tpl');
  }
  
}

?>