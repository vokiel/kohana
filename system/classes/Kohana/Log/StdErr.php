<?php namespace Kohana\Log;
/**
 * STDERR log writer. Writes out messages to STDERR.
 *
 * @package    Kohana
 * @category   Logging
 * @author     Kohana Team
 * @copyright  (c) 2008-2012 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class StdErr extends Writer {
	/**
	 * Writes each of the messages to STDERR.
	 *
	 *     $writer->write($messages);
	 *
	 * @param   array   $messages
	 * @return  void
	 */
	public function write(array $messages)
	{
		foreach ($messages as $message)
		{
			// Writes out each message
			fwrite(STDERR, $this->format_message($message).PHP_EOL);
		}
	}

} // End Kohana_Log_StdErr
