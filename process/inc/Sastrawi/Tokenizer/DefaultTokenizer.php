<?php

namespace Sastrawi\Tokenizer;

use Sastrawi\Tokenizer\CharAnalyzer\AnalyzerInterface;
use Sastrawi\Trka\Finder\EntityFinderFactory;
include 'TokenizerInterface.php';

class DefaultTokenizer implements TokenizerInterface
{

    private $analyzers = array();

    private $entityFinder;

    public function __construct()
    {
        $this->addAnalyzer(new CharAnalyzer\Alphanumeric());
        $this->addAnalyzer(new CharAnalyzer\Whitespace());
        $this->addAnalyzer(new CharAnalyzer\Punctuation());
        $this->addAnalyzer(new CharAnalyzer\Hyphen());

        $entityFinderFactory = new EntityFinderFactory();
        $this->entityFinder  = $entityFinderFactory->create();
    }

    public function addAnalyzers(array $analyzers)
    {
        foreach ($analyzers as $analyzer) {
            $this->addAnalyzer($analyzer);
        }
    }

    public function addAnalyzer(AnalyzerInterface $analyzer)
    {
        $this->analyzers[] = $analyzer;
    }

    public function getAnalyzers()
    {
        return $this->analyzers;
    }

    /**
     * {@inheritdoc}
     */
    public function tokenize($text)
    {
        $tokens = array();
        $tokenBuffer = '';

        $entities = $this->entityFinder->find($text);

        for ($i = 0; $i < strlen($text); $i++) {
            $model = new CharAnalyzer\Model($text, $i);

            $analyzerResultFalse = 0;
            $analyzerResultTrue  = 0;
            $analyzerResultNull  = 0;
            $analyzerResult = null;

            foreach ($this->analyzers as $analyzer) {
                $analyzerResult = $analyzer->shouldSplit($model);

                if ($analyzerResult === true) {
                    $analyzerResultTrue++;
                } elseif ($analyzerResult === false) {
                    $analyzerResultFalse++;
                } elseif ($analyzerResult === null) {
                    $analyzerResultNull++;
                }
            }

            if ($this->isCharEntity($i, $entities)) {
                // don't split entity
                $tokenBuffer .= $model->getCurrentChar();
            } elseif ($analyzerResultTrue > 0 && $analyzerResultTrue >= $analyzerResultFalse) {
                if ($model->getCurrentChar() !== ' ') {
                    if (!empty($tokenBuffer)) {
                        $tokens[] = $tokenBuffer;
                        $tokenBuffer = '';
                    }

                    $tokenBuffer = $model->getCurrentChar();
                } else {
                    if (!empty($tokenBuffer)) {
                        $tokens[] = $tokenBuffer;
                        $tokenBuffer = '';
                    }
                }
            } else {
                $tokenBuffer .= $model->getCurrentChar();
            }
        }

        if (!empty($tokenBuffer)) {
            $tokens[] = $tokenBuffer;
        }

        return $tokens;
    }

    private function isCharEntity($charPos, array $entities)
    {
        foreach ($entities as $span) {
            if ($span->containsIndex($charPos)) {
                return true;
            }
        }

        return false;
    }
}
