/**
 * External dependencies
 */
import PropTypes from 'prop-types';
import { Fragment } from 'react';
import classNames from 'classnames';

/**
 * Component used to render an accessible text given a label and/or a
 * screenReaderLabel. The wrapper element and wrapper props can also be
 * specified via props.
 *
 * @param {Object} props Incoming props for the component.
 * @param {string} props.label Label content.
 * @param {string} props.screenReaderLabel Content for screen readers.
 * @param {string} props.wrapperElement What element is used to wrap the label.
 * @param {Object} props.wrapperProps Props passed into wrapper element.
 */
const Label = ( {
	label,
	screenReaderLabel,
	wrapperElement,
	wrapperProps,
} ) => {
	let Wrapper;

	const hasLabel = typeof label !== 'undefined' && label !== null;
	const hasScreenReaderLabel =
		typeof screenReaderLabel !== 'undefined' && screenReaderLabel !== null;

	if ( ! hasLabel && hasScreenReaderLabel ) {
		Wrapper = wrapperElement || 'span';
		wrapperProps = {
			...wrapperProps,
			className: classNames(
				wrapperProps.className,
				'screen-reader-text'
			),
		};

		return <Wrapper { ...wrapperProps }>{ screenReaderLabel }</Wrapper>;
	}

	Wrapper = wrapperElement || Fragment;

	if ( hasLabel && hasScreenReaderLabel && label !== screenReaderLabel ) {
		return (
			<Wrapper { ...wrapperProps }>
				<span aria-hidden="true">{ label }</span>
				<span className="screen-reader-text">
					{ screenReaderLabel }
				</span>
			</Wrapper>
		);
	}

	return <Wrapper { ...wrapperProps }>{ label }</Wrapper>;
};

Label.propTypes = {
	label: PropTypes.node,
	screenReaderLabel: PropTypes.node,
	wrapperElement: PropTypes.elementType,
	wrapperProps: PropTypes.object,
};

Label.defaultProps = {
	wrapperProps: {},
};

export default Label;
