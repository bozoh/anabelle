<?php

declare(strict_types=1);

namespace Ublaboo\Anabelle\Markdown\Macro;

final class MacroBlockVariable extends AbstractMacroVariable implements IMacro
{

	protected function runVariableMacro(string & $content, int $depth): void // Intentionally &
	{
		/**
		 * Remove lines with inline variables definition and put then into DocuScope
		 */
		$content = preg_replace_callback(
			'/\$\$(.+?)\n(.+?)\$\$/ms',
			function(array $input): string {
				$this->docuScope->addBlockVariable(trim($input[1]), $input[2]);

				return '';
			},
			$content
		);
	}
}
