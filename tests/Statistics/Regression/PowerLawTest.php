<?php
namespace MathPHP\Tests\Statistics\Regression;

use MathPHP\Statistics\Regression\PowerLaw;

class PowerLawTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testCase constructor
     */
    public function testConstructor()
    {
        $points = [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ];
        $regression = new PowerLaw($points);
        $this->assertInstanceOf(\MathPHP\Statistics\Regression\Regression::class, $regression);
        $this->assertInstanceOf(\MathPHP\Statistics\Regression\PowerLaw::class, $regression);
    }

    /**
     * @testCase     getEquation - Equation matches pattern y = axᵇ
     * @dataProvider dataProviderForEquation
     * @param        array $points
     */
    public function testGetEquation(array $points)
    {
        $regression = new PowerLaw($points);
        $this->assertRegExp('/^y = \d+[.]\d+x\^\d+[.]\d+$/', $regression->getEquation());
    }

    /**
     * @return array [points]
     */
    public function dataProviderForEquation(): array
    {
        return [
            [
                [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ],
            ]
        ];
    }

    /**
     * @testCase     getParameters
     * @dataProvider dataProviderForParameters
     * @param        array $points
     * @param        float $a
     * @param        float $b
     */
    public function testGetParameters(array $points, float $a, float $b)
    {
        $regression = new PowerLaw($points);
        $parameters = $regression->getParameters();
        $this->assertEquals($a, $parameters['a'], '', 0.0001);
        $this->assertEquals($b, $parameters['b'], '', 0.0001);
    }

    /**
     * @return array [points, a, b]
     */
    public function dataProviderForParameters(): array
    {
        return [
            [
                [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ],
                56.48338, 0.2641538,
            ],
        ];
    }

    /**
     * @testCase     evaluate
     * @dataProvider dataProviderForEvaluate
     * @param        array $points
     * @param        float $x
     * @param        float $y
     */
    public function testEvaluate(array $points, float $x, float $y)
    {
        $regression = new PowerLaw($points);
        $this->assertEquals($y, $regression->evaluate($x), '', 0.0001);
    }

    /**
     * @return array [points, x, y]
     */
    public function dataProviderForEvaluate(): array
    {
        // y = 56.48338x^0.2641538
        return [
            [
                [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ],
                83, 181.4898448,
            ],
            [
                [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ],
                71, 174.1556182,
            ],
            [
                [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ],
                64, 169.4454327,
            ],
            [
                [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ],
                57, 164.3393562,
            ],
            [
                [ [ 83, 183 ], [ 71, 168 ], [ 64, 171 ], [ 69, 178 ], [ 69, 176 ], [ 64, 172 ], [ 68, 165 ], [ 59, 158 ], [ 81, 183 ], [ 91, 182 ], [ 57, 163 ], [ 65, 175 ], [ 58, 164 ], [ 62, 175 ] ],
                91, 185.955396,
            ],
        ];
    }
}
