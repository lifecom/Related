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

class PluginRelated_ModuleRelated extends Module {
		protected $oMapper = null;

		public function Init(){
				$this->oMapper = Engine::GetMapper ( __CLASS__ );
		}
		
		function GetSimilarTopicsByTopic (ModuleTopic_EntityTopic $currentTopic, $countTopics = 10, $oOrderBy, $oOrderByDirection) {
				if ($currentTopic == null) {
						return array ();
				}

				$key = "similar_topics_by_tags_for_" . $currentTopic -> getId() . " " . $countTopics . " " . $oOrderBy . " " . $oOrderByDirection;

				if ($content = $this -> Cache_Get ($key)) {
						return $content;
				}

				$topicsId = $this -> oMapper -> getTopicIdForTags (
						$currentTopic -> getTagsArray (),
						$countTopics + 1,
						$oOrderBy,
						$oOrderByDirection
				);

				$topics = $this -> Topic_GetTopicsAdditionalData ($topicsId, array('user' => array(), 'blog' => array ('owner' => array ())));

				$returnValue = array ();
				if (is_array ($topics)) {
						foreach ($topics as $iTopicId => $oTopic) {
								if ($oTopic -> getId() != $currentTopic -> getId ()) {
										$returnValue [] = $oTopic;
								}
						}
				}

				$this -> Cache_Set ($returnValue, $key, array ('topic_update'), 60 * 10);

				return $returnValue;
		}
}
