<div id="quiz">
   <div id="question">

      {$language[$quiz[0]]}

   </div>

   <div id="answerContainer">

      <div id="answer">

         <img id="logo" src="pictures/{$quiz[1]}.png" width="300" height="300" border="0"/>

         <form action="index.php?page=plantwizard" method="post">
            <input type="hidden" name="answer" value="{$quiz[1]}"/>
            <input type="hidden" name="qpart" value="{$quiz[4]}"/>
            <button id="answerButton" type="submit">{$language[$quiz[1]]}</button>
         </form>

      </div>

      <div id="answer">

         <img id="logo" src="pictures/{$quiz[2]}.png" width="300" height="300" border="0"/>

         <form action="index.php?page=plantwizard" method="post">
            <input type="hidden" name="answer" value="{$quiz[2]}"/>
            <input type="hidden" name="qpart" value="{$quiz[4]}"/>
            <button id="answerButton" type="submit">{$language[$quiz[2]]}</button>
         </form>

      </div>

      <div id="answer">

         <img id="logo" src="pictures/{$quiz[3]}.png" width="300" height="300" border="0"/>

         <form action="index.php?page=plantwizard" method="post">
            <input type="hidden" name="answer" value="{$quiz[3]}"/>
            <input type="hidden" name="qpart" value="{$quiz[4]}"/>
            <button id="answerButton" type="submit">{$language[$quiz[3]]}</button>
         </form>

      </div>
   </div>
</div>