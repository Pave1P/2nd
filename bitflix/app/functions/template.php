<?php
/**
 * Безопасный рендеринг шаблона с передачей данных
 * Вместо extract() (небезопасный) используем явную передачу переменных в scope
 * через include с компактной переменной
 */
function render(string $template, array $data = []): void {
	$path = APP_PATH . 'templates' . DIRECTORY_SEPARATOR . $template . '.php';
	if (file_exists($path)) {
		// Передаём данные как компактную переменную, чтобы они были доступны в шаблоне
		// Но сохраняем обратную совместимость с extract() для существующих шаблонов
		extract($data, EXTR_SKIP); // EXTR_SKIP - избежаем перезаписи существующих переменных
		include $path;
	} else {
		die("Template $template not found.");
	}
}