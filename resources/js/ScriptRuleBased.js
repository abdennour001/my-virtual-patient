/**
 *
 * ScriptRuleBased.js
 *
 * 	This script contains the main rules that we gonna use in our rule based algotithm.
 *
 * 	We will be using several rules in order to determine how much the student answer is close to the	*			questions in the teacher database.
 *
 *	All functions take strings - @param - in lower case.
 *
 */

    /**
     *
     *	Rule #1: Check if the questionA and the questionB has the same wh word
     *
     *	@param {string} questionA - the first question
     *	@param {string} questionB - the second question
     *	@return {boolean} Set to `true` if both questions have the same wh word,
     *	`false` otherwise.
     *
     */
    function checkWhWord(questionA, questionB) {
        // check if there is the same Wh word in both questions `What`, `When`, `Who`, `Why` and `Where`
        return (questionA.search('what') !== -1 && questionB.search('what') !== -1)
            || (questionA.search('when') !== -1 && questionB.search('when') !== -1)
            || (questionA.search('who') !== -1 && questionB.search('who') !== -1)
            || (questionA.search('why') !== -1 && questionB.search('why') !== -1)
            || (questionA.search('where') !== -1 && questionB.search('where') !== -1);
    }

    /**
     *
     *	Rule #2: Check the first expression used, useful in closed ended question
     * (e.g. `Do you?`, `Has it?`, `Have you?`, `Are you?`, `Does it?`, ...)
     *
     *	@param {string} questionA - the first question
     *	@param {string} questionB - the second question
     *	@return {Array} Set to `true` if both questions have the same beginning expression,
     *	`false` otherwise in the first index, set the second index to the count of match words from the beginning,
     *	(e.g. Do you...? and Do you...? then return [ture, 2]),
     *	(e.g. Did they...? and Did you...? then return [true, 1]).
     *
     *	if first index is false then second index is 0.
     *
     */
    function checkBeginning(questionA, questionB) {
        let curr_index=0;
        let questionAArray=questionA.split(/[\s!.;,?]+/);
        let questionBArray=questionB.split(/[\s!.;,?]+/);
        while (questionAArray[curr_index] === questionBArray[curr_index]
        && curr_index < Math.min(questionAArray.length, questionBArray.length)) {
            curr_index++;
        }
        return [curr_index !== 0, curr_index];
    }

    /**
     *
     *	Rule #3: Count the number of words that appear in both questions.
     *
     *	@param {string} questionA - the first question
     *	@param {string} questionB - the second question
     *	@return {int} The count.
     *
     */
    function wordMatch(questionA, questionB) {
        let count=0;

        // Iterate through the questionA words and search for it on the questionB
        let word='';
        for (word of questionA.split(/[\s?!.;,]+/)) {
            if (questionB.search(word) !== -1 && word !== '') count++;
        }
        return count;
    }

    /**
     *
     *	Rule #4: Count the number of Synonyms that appear in both questions, for example if questionA contains the word,
     *	`injury` and questionB contains the word `harm` or `wound` or `hurt`, it will be counted.
     *
     *	This rule will be implemented using API calls to fetch word sysnonyms then we do the match.
     *
     *	@param {string} questionA - the first question
     *	@param {string} questionB - the second question
     *	@return {int} The count.
     *
     */
    function wordMatchSynonyms(questionA, questionB) {
        let count=0;

        // Iterate through the questionA words and search for it on the questionB
        let word='';
        for (word of questionA.split(/[\s!.;,?]+/)) {
            if (word !== 'what' && word !== 'where' && word !== 'when' && word !== 'how' && word !== 'who') {
                let syn = fetchSynonymsApi(word);
                let synonym = '';
                for (synonym of syn) {
                    if (questionB.search(synonym) !== -1) {
                        count++;
                        //console.log(questionB.search(synonym) + ' ' + count + ' ' + synonym + ' ' + word + '\n');
                        break;
                    }
                }
            }
        }

        return count;
    }

    /**
     *
     *	Rule #5: Check if both questions have the same type of questions (open ended or closed ended questions).
     *
     *	@param {string} questionA - the first question
     *	@param {string} questionB - the second question
     *	@return {boolean} Set to `true` if both questions have the same type,
     *	`false` otherwise.
     *
     */
    function checkQuestionType(questionA, questionB) {
        let whWords = ['what', 'when', 'where', 'who', 'why'];
        let closedEndedKeywords = ['has', 'do', 'does', 'did', 'have', 'are you', 'are they', 'are'];

        if (isWhQuestion(questionA) && isWhQuestion(questionB)) {
            return true;
        } else {
            let a=false;
            let b=false;
            for (key of closedEndedKeywords) {
                if (questionA.search(key) !== 0) {
                    a = true;
                }
                if (questionB.search(key) !== 0) {
                    b = true;
                }
                if (a && b) return true;
            }
        };

        return false;
    }

    /**
     *
     *	Rule #6: Try to match between two questions based on some special keys,
     *	(e.g. keys that distinguishes `When` questions : `time`, `how long`, `has it been`, `before`, `after`, `start`, ...).
     *	(e.g. keys that distinguishes `Where` questions : `now`, `anywhere`, `exactly`, `show me`, `place`, `body`, `onset`, ...).
     *
     *	@param {string} questionA - the first question
     *	@param {string} questionB - the second question
     *	@param {Array} keywordsSetA - the first question's keywords
     *	@param {Array} keywordsSetB - the second question's keywords
     *	@return {boolean} set if the questionB has similar keywords,
     *
     */
    function specialKeysSimilarity(questionA, questionB, keywordsSetA, keywordsSetB) {
        let rate = false;
        let specialKeys = {
            'when' : ['what time', 'at time', 'time', 'now', 'how long', 'long', 'has it been', 'been', 'new', 'old',
                'first', 'first time', 'time', 'past', 'present', 'before', 'after', 'happened', 'happen', 'did', 'start', 'end', 'period'],
            'where' : ['anywhere', 'radiate ', 'go', 'goes', 'exactly', 'show me where', 'where', 'show me', 'show', 'onset']
        };

        // `when` wh word case
        if (questionA.search('when') !== -1 ) {
            for (key of specialKeys['when']) {
                if (questionB.search(key) !== -1) {
                    return true;
                }
            }
            return false;
        } else if (questionB.search('when') !== -1) {
            for (key of specialKeys['when']) {
                if (questionA.search(key) !== -1) {
                    return true;
                }
            }
            return false;
        }

        // `where` wh word case
        if (questionA.search('where') !== -1 ) {
            for (key of specialKeys['where']) {
                if (questionB.search(key) !== -1) {
                    return true;
                }
            }
            return false;
        } else if (questionB.search('where') !== -1) {
            for (key of specialKeys['where']) {
                if (questionA.search(key) !== -1) {
                    return true;
                }
            }
            return false;
        }

        return false;
    }

    /**
     *
     *	Rule #7: Count the number of keywords that appear in both questions.
     *
     *	@param {Array} keywordsSetA - the first question keywords
     *	@param {Array} keywordsSetB - the second question keywords
     *	@return {int} The count.
     *
     */
    function KeywordsMatch(keywordsSetA, keywordsSetB) {
        let count=0;

        let keyword = '';
        for (keyword of keywordsSetA) {
            if (keywordsSetB.includes(keyword)) {
                count++;
            }
        }
        return count;
    }

    /**
     * This function is to get synonyms using the `words.bighugelabs` API
     * @param {*} word - word to get synonyms for
     */
    function fetchSynonymsApi(word) {
        let api_url="https://words.bighugelabs.com/api/2/2d33853e07cdc56d8a7519f13663507a/"+word+"/json";
        let syn = [];
        // The jQuery Ajax Asynchronous request to ask for the synonyms
        $.getJSON( api_url ).done( function(data) {
            $.each(data, function(i,item){
                syn = item.syn;
            });
        }).fail(function(jqxhr){
            //alert(jqxhr.responseText);
        });
        return syn;
    }

    /**
     * Check if the question is a wh question.
     * @param {string} question
     * @return {number} 1 if the question is wh question, 0 otherwise.
     */
     function isWhQuestion(question) {
        let whWords = ['what', 'when', 'where', 'who', 'why'];

        let wh='';
        for (wh of whWords) {
            if (question.search(wh)) {
                return 1;
            }
        }

        return 0;
    }

    /**
     * Main function that will calculate the rate of the student answer, [rate from 0 to 1]
     *
     * @return {number} Rate of correctness of the student.
     */
    function main(studentAnswer, questions) {
        let questionsRate = [];
        let slamDankRates = {
            'rule1': 0.1628, // checkWhWord
            'rule2': 0.1528, // checkBeginning
            'rule3': 0.1428, // wordMatch
            'rule4': 0.1428, // wordMatchSynonyms
            'rule5': 0.1128, // checkQuestionType
            'rule6': 0.1328, // specialKeysSimilarity
            'rule7': 0.1528, // KeywordsMatch
        };

        // we will apply the rules one to one between the student question  and
        // every other related question.

        console.clear();

        for (let question of questions) {
            let questionRate=0.0;

            // Rule #1
            //console.log('checkWhWord : ' + checkWhWord(studentAnswer, question));
            if (checkWhWord(studentAnswer, question)) questionRate += slamDankRates['rule1'];
            // Rule #2
            //console.log('checkBeginning : ' + checkBeginning(studentAnswer, question));
            if (checkBeginning(studentAnswer, question)[0]) {
                questionRate += slamDankRates['rule2'];
            }
            // Rule #3
            //console.log('wordMatch : ' + wordMatch(studentAnswer, question));
            let n = wordMatch(studentAnswer, question);
            if (n > 0) {
                let l = Math.min(studentAnswer.length, question.length);
                questionRate += slamDankRates['rule3'];
            }
            // Rule #4
            //console.log('wordMatchSynonyms : ' + wordMatchSynonyms(studentAnswer, question));
            let o = wordMatchSynonyms(studentAnswer, question);
            if (o > 0) {
                let l = Math.min(studentAnswer.length, question.length);
                questionRate += slamDankRates['rule4'];
            }
            // Rule #5
            //console.log('checkQuestionType : ' + checkQuestionType(studentAnswer, question));
            if (checkQuestionType(studentAnswer, question)) {
                questionRate += slamDankRates['rule5'];
            }
            // Rule #6
            if (specialKeysSimilarity(studentAnswer, question, studentAnswer.split(/[\s!.;,?]+/), standardKeywords)) {
                questionRate += slamDankRates['rule6'];
            }
            // Rule #7
            if (KeywordsMatch(studentAnswer.split(/[\s!.;,?]+/), standardKeywords)) {
                questionRate += slamDankRates['rule7'];
            }

            questionsRate.push(questionRate);
        }

        return Math.max(...questionsRate);
    }

    /**
     * getScore function that will calculate the score of the student answers, [score from 0 to 100]
     *
     * @param {Array} studentAnswers - Student Answers.
     * @param {Array} questions - Questions.
     * @return {number} Score of the student.
     */
    export function getScore(studentAnswers, questions) {
        let maxScore = 100;
        let studentScore = 0;
        let numberOfQuestions = studentAnswers.length;
        let partialScore = Math.floor(maxScore / numberOfQuestions);
        let rate=0;

        for (let i = 0; i < numberOfQuestions; i++) {
            rate = main(studentAnswers[i], questions[i]);
            studentScore += partialScore * rate;
        }

        return studentScore;
    }
