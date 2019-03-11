<footer class="navbar font-small p-4 bg-dark">
<div>
	<?= $this->tag->form(['theme/change', 'class' => 'form-inline']) ?>
		<div class="input-group">
			<?= $this->tag->select(['theme', ['стандартная' => 'стандартная', 'darkly' => 'darkly', 'lux' => 'lux', 'minity' => 'minity', 'materia' => 'materia', 'superhero' => 'superhero', 'lumen' => 'lumen', 'cyborg' => 'cyborg'], 'class' => 'form-control']) ?> 
			<div class="input-group-append">
				<?= $this->tag->submitButton(['изменить', 'class' => 'btn btn-info']) ?>
			</div>
		</div>
	<?= $this->tag->endForm() ?>
</div>
<span>Система для управления хоздоговорной деятельностью <a href="http://volpi.ru">ВПИ</a>.</span>
</footer>