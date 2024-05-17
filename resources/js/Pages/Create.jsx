import { Editor } from '@/Components/plate-ui/editor';

const Create = () => {
	const initialValue = [
		{
			type: 'p',
			children: [
				{
					text: 'This is editable plain text with react and history plugins, just like a <textarea>!',
				},
			],
		},
	];

	const handleOnChange = (newValue) => {
		console.log({newValue});
	};

	return (
		<Plate initialValue={initialValue} onChange={handleOnChange}>
			<Editor placeholder="Type..." />
		</Plate>
	);
};

export default Create;
