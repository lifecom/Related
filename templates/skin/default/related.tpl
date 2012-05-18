{if $aSimilarTopics}
     <h3>{$aLang.related_topics_title}</h3>
     {foreach from=$aSimilarTopics item=oTopic name=nTopicCycle}
       {assign var="oBlog" value=$oTopic->getBlog()}
       {assign var="oUser" value=$oTopic->getUser()}
       <div class="OneSimilarTopicCont {if $smarty.foreach.nTopicCycle.iteration % 2 == 0}even{/if}">
           {if $oTopic->getType()=='link'}
             <a class="topic_title" href="{router page='link'}go/{$oTopic->getId()}/">{$oTopic->getTitle()|escape:'html'}</a>
           {else}
             <a class="topic_title" href="{$oTopic->getUrl()}">{$oTopic->getTitle()|escape:'html'}</a>
           {/if}
           &rarr; 
           <a href="{$oBlog->getUrlFull()}" class="blogtitle">{$oBlog->getTitle()|escape:'html'}</a>
       </div>
     {/foreach}
{/if}