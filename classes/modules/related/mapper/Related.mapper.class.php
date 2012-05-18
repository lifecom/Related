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

class PluginRelated_ModuleRelated_MapperRelated extends Mapper {

  function getTopicIdForTags ($tags, $limit, $orderBy = "rating", $orderByDirection = 0) {
    $tagsCount = sizeof ($tags);
    if (sizeof ($tags) == 0) {
      return array ();
    }

    $sql = "SELECT
      topic_tag.topic_id,
      topic.topic_rating,
      COUNT(*) AS `tags_count`
      FROM
      `" . Config::Get('db.table.topic_tag') . "` AS topic_tag,
      `" . Config::Get('db.table.topic') ."` AS topic
      WHERE
      topic.topic_publish = 1
      AND topic_tag.topic_id = topic.topic_id
      AND topic_tag_text in (
    ";

    for ($i = 0; $i < $tagsCount; $i ++) {
      if ($i!=0) $sql .= ",";
      $sql .= "'" . mysql_real_escape_string ($tags [$i]) . "'";
    }

    $sql .= ") ";

    $sql .= "GROUP BY topic_tag.topic_id
      ORDER BY
      tags_count DESC
    ";

    if ($orderBy == "rating") {
      $sql .= " , topic.topic_rating ";
    } else {
      $sql .= ", topic.topic_date_edit ";
    }

    if ($orderByDirection == 1) {
      $sql .= " DESC ";
    }

    $sql .= "LIMIT 0," . mysql_real_escape_string ($limit);

    $result = $this -> oDb -> select ($sql);

    $returnValue = array ();
    $resultCount = sizeof ($result);
    for($i = 0; $i < $resultCount; $i++) {
      $returnValue [] = $result [$i]['topic_id'];
    }

    return  $returnValue;
  }

}
