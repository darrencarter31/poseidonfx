<?php
 
/* ---------------------------------------------------------------------- */
/*	Custom Signal Input -> Output Function
/* ---------------------------------------------------------------------- */

function poseidon_signal($content, $post_id) 
{
$ptitle = get_the_title($post_id);
$input = $content;

//	$output = '1';

//	$content = $output;
//	$title = $actionuc.' '.$pair.' - '.$timed;
//	$my_post = array('ID' => $post_id, 'post_content' => $content, 'post_title' => $title);
//	remove_action( 'save_post', 'poseidon_signal_check' );
//	wp_update_post( $my_post );
//	add_action( 'save_post', 'poseidon_signal_check' );

if ($ptitle == $content)
{
	if (strpos($input, 'Bought') !== FALSE)
	{
		$action = 'buy';
		$actionuc = 'Buy';
		$position = 'long';
		$retail = 'short';
	}
	elseif (strpos($input, 'Sold') !== FALSE)
	{
		$action = 'sell';
		$actionuc = 'Sell';
		$position = 'short';
		$retail = 'long';
	}
	elseif (strpos($input, 'Closed Buy') !== FALSE)
	{
		$action = 'close long';
		$actionuc = 'Close Long';
		$position = 'long';
		$retail = 'short';
	}
	elseif (strpos($input, 'Closed Sell') !== FALSE)
	{
		$action = 'close short';
		$actionuc = 'Close Short';
		$position = 'short';
		$retail = 'long';
	}

	$rate = explode('for', $input); 
	$rate[0] = filter_var($rate[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

	$pl = filter_var($rate[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$time = date( 'F j, Y G:i', current_time( 'timestamp', 1 ) ).' GMT';
	$timed = date( 'M j, Y', current_time( 'timestamp', 1 ) ); 
	if ($pl >=  0) {
	$gainloss = 'gain of';
	} elseif ($pl < 0) {
	$gainloss = 'loss of'; }
	
	if (strpos($input, 'AUDUSD') !== FALSE)
	{
		$pair = 'AUDUSD';
		$algo = 'CrowdThunderFX';
	}
	elseif (strpos($input, 'NZDUSD') !== FALSE)
	{
		$pair = 'NZDUSD';
		$algo = 'CrowdThunderFX';
	}
	elseif (strpos($input, 'CHFJPY') !== FALSE)
	{
		$pair = 'CHFJPY';
		$algo = 'CrowdStormFX';
	}
	elseif (strpos($input, 'GBPJPY') !== FALSE)
	{
		$pair = 'GBPJPY';
		$algo = 'CrowdStormFX';
	}
	elseif (strpos($input, 'NZDJPY') !== FALSE)
	{
		$pair = 'NZDJPY';
		$algo = 'CrowdStormFX';
	}
	elseif (strpos($input, 'EURJPY') !== FALSE)
	{
		$pair = 'EURJPY';
		$algo = 'CrowdThunderFX';
	}
	elseif (strpos($input, 'EURUSD') !== FALSE)
	{
		$pair = 'EURUSD';
		$algo = 'CrowdThunderFX';
	}
	elseif (strpos($input, 'USDJPY') !== FALSE)
	{
		$pair = 'USDJPY';
		$algo = 'CrowdThunderFX';
	}
	elseif (strpos($input, 'EURAUD') !== FALSE)
	{
		$pair = 'EURAUD';
		$algo = 'CrowdThunderFX';
	}
	elseif (strpos($input, 'EURGBP') !== FALSE)
	{
		$pair = 'EURGBP';
		$algo = 'CrowdStormFX';
	}
	elseif (strpos($input, 'USDCHF') !== FALSE)
	{
		$pair = 'USDCHF';
		$algo = 'CrowdStormFX';
	}
	elseif (strpos($input, 'USDCAD') !== FALSE)
	{
		$pair = 'USDCAD';
		$algo = 'CrowdStormFX';
	}
	elseif (strpos($input, 'GBPUSD') !== FALSE)
	{
		$pair = 'GBPUSD';
		$algo = 'CrowdThunderFX';
	}
	elseif (strpos($input, 'AUDJPY') !== FALSE)
	{
		$pair = 'AUDJPY';
		$algo = 'CrowdStormFX';
	}

	if ($action == 'buy' OR $action == 'sell')
	{
		if ($algo == 'CrowdStormFX')
		{
			$output = 'We have just opened a new '.$position.' position on '.$pair.', entering the position at '.$rate[0].'. To follow this signal, '.$action.' '.$pair.' at or near '.$rate[0].' as soon as possible.<br /><br />Time: '.$time.'<br />Trade: '.$actionuc.' '.$pair.'<br />Rate: '.$rate[0].'<br /><br /><strong>Why did we take this trade?</strong><br /><br />Retail traders have recently increased their '.$retail.' positions on '.$pair.', while the underlying market looks to be moving against them. PoseidonFX is going '.$position.' '.$pair.' with an anticipated trade duration of anywhere from 2 days to 3 weeks.<br /><br />
<strong>';
		}
		elseif ($algo == 'CrowdThunderFX')
		{
			$output = 'We have just opened a new '.$position.' position on '.$pair.', entering the position at '.$rate[0].'. To follow this signal, '.$action.' '.$pair.' at or near '.$rate[0].' as soon as possible.<br /><br />Time: '.$time.'<br />Trade: '.$actionuc.' '.$pair.'<br />Rate: '.$rate[0].'<br /><br />
<strong>Why did we take this trade?</strong>
<br /><br />Retail traders appear to have moved net '.$retail.' '.$pair.', while the underlying market looks to be moving against them. PoseidonFX is going '.$position.' '.$pair.' with an anticipated trade duration of anywhere from 5 days to 12 months.<br /><br />
<strong>';
		}
		elseif ($algo == 'TradeWindsFX')
		{
			$output = 'We have just opened a new '.$position.' position on '.$pair.', entering the position at '.$rate[0].'. To follow this signal, '.$action.' '.$pair.' at or near '.$rate[0].' as soon as possible.<br /><br />Time: '.$time.'<br />Trade: '.$actionuc.' '.$pair.'<br />Rate: '.$rate[0].'<br /><br />
<strong>Why did we take this trade?</strong>
<br /><br />'.$pair.' has just hit a favorable buying price. In order to enter a position and capture the overnight interest rate differential for as long as possible, PoseidonFX is going long '.$pair.'. We hope to remain in this position for as long as the market is in a range or an uptrend, exiting only when volatility increases and price moves to the downside. The duration for this trade is likely to be a minimum of a few weeks - ideally, it will be held for several months or more if conditions permit.<br /><br />
<strong>';
		}
	}
	elseif ($action == 'close short' OR $action == 'close long')
	{
		if ($algo == 'CrowdStormFX')
		{
			$output = 'We are closing our '.$position.' '.$pair.' position, originally opened at '.$rate[0].', for a total '.$gainloss.' of '.$pl.' pips.  To follow this signal, exit the position as soon as possible.<br /><br />Time: '.$time.'<br />Trade: '.$actionuc.' '.$pair.'<br />Rate: '.$rate[0].'<br /><br />P/L: '.$pl.' pips<br /><br />
<strong>Why did we close this trade?</strong>
<br /><br />We opened this trade when we saw retail traders had increased their '.$retail.' positions on '.$pair.', while the underlying market looked to be moving against them. PoseidonFX went '.$position.' '.$pair.' with an anticipated trade duration of anywhere from 2 days to 3 weeks.<br /><br />
<strong>';
		}
		elseif ($algo == 'CrowdThunderFX')
		{
			$output = 'We are closing our '.$position.' '.$pair.' position, originally opened at '.$rate[0].', for a total '.$gainloss.' of '.$pl.' pips. To follow this signal, exit the position as soon as possible.<br /><br />Time: '.$time.'<br />Trade: '.$actionuc.' '.$pair.'<br /><br />Rate: '.$rate[0].'<br /><br />P/L: '.$pl.' pips<br /><br />
<strong>Why did we close this trade?</strong>
<br /><br />We opened this trade when we saw retail traders moving heavily to a net '.$retail.' position on '.$pair.' while the underlying market looked to be moving against them. We originally went '.$position.' '.$pair.' with an anticipated trade duration of anywhere from 5 days to 12 months.<br /><br />
<strong>';
		}
		elseif ($algo == 'TradeWindsFX')
		{
			$output = 'We are closing our '.$position.' '.$pair.' position, originally opened at '.$rate[0].', for a total '.$gainloss.' of '.$pl.' pips. To follow this trade, exit the position as soon as possible.<br /><br />Time: '.$time.'<br />Trade: '.$actionuc.' '.$pair.'<br />Rate: '.$rate[0].'<br />P/L: '.$pl.' pips<br /><br />
<strong>Why did we close this trade?</strong>
<br /><br />When we entered this trade, our algorithm had determined that '.$pair.' had hit a favorable buying price. In order to capture the overnight interest rate differential for as long as possible and take advantage of the discounted entry price, PoseidonFX went long '.$pair.'. We hoped to remain in this position for as long as the market was in a range or an uptrend, exiting only when volatility increased and price moved to the downside. Upon entering the trade, the expected duration was anywhere from a few weeks to several months.<br /><br />
<strong>';
		}
	}
	if ($algo == 'CrowdStormFX')
	{
		$output .= 'About the Algorithm That Identified This Trade</strong>
<br /><br />This algorithm targets medium-term price swings that typically result from retail crowds trying to sell into uptrends, or buy into downtrends. We look to do the opposite, buying into strength and holding on as long as the price continues to move in our favor.  This algorithm will perform best in volatile markets with sharp movements in one particular direction for at least a few days before reversing.';
	}
	elseif ($algo == 'CrowdThunderFX')
	{
		$output .= 'About the Algorithm That Identified This Trade</strong>
<br /><br />This algorithm targets long term trends that usually result in retail crowds trying to sell into uptrends or buy into downtrends. We look to do the opposite, buying into strength and holding on as long as the price continues to move in our favor. This algorithm will perform best in volatile markets with smooth, sustained trends that last a long time.';
	}
	elseif ($algo == 'TradeWindsFX')
	{
		$output .= 'About the Algorithm That Identified This Trade</strong>
<br /><br />This algorithm primarily targets interest rate differentials, and low to medium amounts of actual price movement. The goal is to capture the overnight rollover interest, while riding out any short term price swings that happen to occur. Positions are best entered with a brokerage firm offering high interest rates, with little/no markup. These trades should be held as long as possible - even years, if the market either ranges, or trends in an upward direction! This algorithm works best when volatility is low, complementing our other algorithms.';
	}

	$content = $output;
	$title = $actionuc.' '.$pair.' - '.$timed;
	$my_post = array('ID' => $post_id, 'post_content' => $content, 'post_title' => $title);
	remove_action( 'save_post', 'poseidon_signal_check' );
	wp_update_post( $my_post );
	add_action( 'save_post', 'poseidon_signal_check' );

	$plink = get_permalink($post_id);

	$message = '<p style="text-align: center; font-size: 12px;"> <a href="'.$plink.'">Click here to view this signal on our website</a></p><div style="margin: 20px;"><span style="background-color: transparent; color: black;"><font style="font-size: 14px;" size="14">'.$output.'</font></span></div><ul><li><span style="background-color: transparent;"><font style="font-size: 14px;" size="14"><a href="http://poseidonfx.com/poseidonfx-open-positions/" target="_blank" title="http://poseidonfx.com/poseidonfx-open-positions/">View PoseidonFX Current Positions</a></font></span></li><li><span style="background-color: transparent;"><font style="font-size: 14px;" size="14"><a href="http://poseidonfx.com/Sentiment-Trading-White-Paper.pdf" target="_blank" title="http://poseidonfx.com/Sentiment-Trading-White-Paper.pdf">View PoseidonFX Trading Methodology White Paper</a></font></span></li></ul><div style=""><font size="8" style="font-size: 8px;"></font></div></td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" data-editable="text" style="margin-right: auto; margin-left: auto;"><tbody><tr><td align="left" valign="top" style="padding: 10px; font-family: Arial, Helvetica, sans-serif; color: rgb(38, 38, 38); background-image: none;"><div style=""><span style="background-color: transparent;"><font style="font-size: 14px;" size="14">To Your Profits,</font></span></div><div style=""><font style="font-size: 14px;" size="14">Joshua Garrison<br>Founder &amp; CEO of PoseidonFX</font></div></td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" data-editable="text" style="margin-right: auto; margin-left: auto;"><tbody><tr><td align="left" valign="top" style="padding: 10px; font-family: Arial, Helvetica, sans-serif; color: rgb(38, 38, 38); font-style: italic;"><div style=""><font style="font-size: 14px;" size="14"><a href="https://twitter.com/PoseidonFX" target="_blank" title="https://twitter.com/PoseidonFX">Follow Us on Twitter</a> | <a href="https://www.facebook.com/poseidon.fx" target="_blank" title="https://www.facebook.com/poseidon.fx">Like Us on Facebook</a></font></div><div style=""><font style="font-size: 14px;" size="14"><br></font></div><font size="14" style="font-size: 14px;"><a href="mailto:info@poseidonfx.com" target="_blank" title="Email Us">Email</a> | <a href="http://www.poseidonfx.com" target="_blank" title="Visit Us">Website</a> | <a href="http://www.poseidonfx.com/blog/" target="_blank" title="View Our Blog">Blog</a> | <a href="http://www.poseidonfx.com/performance/" target="_blank" title="View Our Performance">Performance</a></font><br><br><font style="font-size: 12px; color: rgb(128, 128, 128);" size="12">Risk Disclaimer: Past performance does not necessarily indicate future results. Trading foreign exchange on margin carries a high level of risk, and may not be suitable for all investors. The high degree of leverage can work against you as well as for you. Before deciding to invest in foreign exchange you should carefully consider your investment objectives, level of experience, and risk appetite. The possibility exists that you could sustain a loss of some or all of your initial investment and therefore you should not invest money that you cannot afford to lose. You should be aware of all the risks associated with foreign exchange trading, and seek advice from an independent financial adviser if you have any doubts.<br><br>You may unsubscribe at any time. To do so, please email <a href="mailto:subscriptions@poseidonfx.com?subject=UNSUBSCRIBE">subscriptions@poseidonfx.com</a> with the subject-line UNSUBSCRIBE.';

	include ( 'emaillist.php' );
	$to = '';
	$headers[] = 'From: PoseidonFX Signal <info@poseidonfx.com>';
	$headers[] = $paid.', '.$free; //called from emaillist.php
	$subject = 'New Signal - '.$actionuc.' '.$pair.' - '.$timed;

	wp_mail($to, $subject, $message, $headers );
}
}

add_filter( 'wp_mail_content_type', 'set_content_type' );

function set_content_type( $content_type ){
	return 'text/html';
}
function poseidon_signal_check() 
{

	$args = array( 'numberposts' => '5' );
	$recent_posts = wp_get_recent_posts( $args );
	$category = 'Premium Signals';
	foreach( $recent_posts as $recent )
	{

		$post_id = $recent["ID"];
		
		if (in_category($category, $post_id)) 
		{
			poseidon_signal($recent["post_content"],$post_id);
		}
	}

}

?>