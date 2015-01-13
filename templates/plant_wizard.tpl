<div id="plantwizard">
   {if $quiz[4] == '1'}
      <h1>{$language['PLANTWIZARD_DESC']}</h1>
   {/if}
   <div id="question">
      <h2>{$language[$quiz[0]]}</h2>
   </div>

   <div id="answerContainer">
      <form action="index.php?page=plantwizard" method="post">
         <input type="hidden" name="qpart" value="{$quiz[4]}"/>
         <div class="answer">
            <img id="logo" src="pictures/{$quiz[1]}.png" width="300" height="300" border="0" />
            <button type="submit" class="answerButton" name="answer" value="{$quiz[5][0]}">
               {$language[$quiz[1]]}
            </button>
         </div>
         <div class="answer">
            <img id="logo" src="pictures/{$quiz[2]}.png" width="300" height="300" border="0" />
            <button type="submit" class="answerButton" name="answer" value="{$quiz[5][1]}">
               {$language[$quiz[2]]}
            </button>
         </div>
         <div class="answer">
            <img id="logo" src="pictures/{$quiz[3]}.png" width="300" height="300" border="0" />
            <button type="submit" class="answerButton" name="answer" value="{$quiz[5][2]}">
               {$language[$quiz[3]]}
            </button>
         </div>
      </form>
   </div>
</div>