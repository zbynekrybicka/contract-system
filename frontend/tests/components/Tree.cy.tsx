import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Tree from '../../src/components/Tree'


describe('Tree.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Tree /></Provider>)
  })
})