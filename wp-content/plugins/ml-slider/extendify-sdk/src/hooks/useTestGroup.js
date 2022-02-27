import { useState, useLayoutEffect } from '@wordpress/element'
import { useUserStore } from '@extendify/state/User'

export const useTestGroup = (key, options) => {
    const [group, setGroup] = useState()
    const testGroup = useUserStore((state) => state.testGroup)

    useLayoutEffect(() => {
        // Let the devbuild reset this
        if (!group || window.extendifyData.devbuild) {
            setGroup(testGroup(key, options))
        }
    }, [key, options, group, testGroup])

    return group
}
