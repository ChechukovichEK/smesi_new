/* ALIAS AND META TITLE
------------------------------------------------------------------------ */

$(document)
	
	.on('click', '[data-toggle="translate_title"]', function(){
		
		let slug = $('[name="alias"]');
		
		slug.val(translit($('[name="title"]').val(), true));
		
	})
	.on('change', '[name="title"]', function(){
		
		let v = $(this).val(),
			slug = $('[name="alias"]')
		
		if(slug.length && slug.val() === '')
		{
			slug.val(translit(v, true));
		}
	});

function translit(str, isLower)
{
	let space = '-',
		result = '',
		current_sim = '',
		translate = {
			'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',  'з': 'z', 'и': 'i', 'й': 'j',
			'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f',
			'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
			'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'E', 'Ж': 'ZH',  'З': 'Z', 'И': 'I', 'Й': 'J',
			'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O', 'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F',
			'Х': 'H', 'Ц': 'C', 'Ч': 'CH', 'Ш': 'SH', 'Щ': 'SH', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'YU', 'Я': 'YA',
			' ': space, '_': space, '`': space, '~': space, '!': space, '@': space, '#': space, '$': space, '%': space,
			'^': space, '&': space, '*': space, '(': space, ')': space, '-': space, '\=': space, '+': space, '[': space,
			']': space, '\\': space, '|': space, '/': space, '.': space, ',': space, '{': space, '}': space, '\'': space,
			'"': space, ';': space, ':': space, '?': space, '<': space, '>': space, '№': space, '»': space, '«':	space
		};
	
	if(isLower) str = str.toLowerCase();
	
	for(let i = 0; i < str.length; i++)
	{
		if(translate[str[i]] !== undefined)
		{
			if(current_sim !== translate[str[i]] || current_sim !== space)
			{
				result += translate[str[i]];
				current_sim = translate[str[i]];
			}
		}
		else {
			result += str[i];
			current_sim = str[i];
		}
	}
	
	result = result.replace(/^-/, '');
	result = result.replace(/[-]{2,}/gim, '-').replace(/[^-0-9a-zA-Z]/gim,'');
	
	return result;
}